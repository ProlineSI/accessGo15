<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;



class ImagesComponent extends Component
{

    /**
     * Table name for Images.
     *
     * @var string 
     */
    var $tableName;


    public function initialize($config){
      parent::initialize($config);
      ConnectionManager::config('s3_connection', [
        'className'  => 'CakeS3\Datasource\Connection',
        'key'        => $config['key'],
        'secret'     => $config['secret'],
        'bucketName' => $config['bucketName'],
        'region'     => $config['region']
      ]);
      $this->tableName = $config['tableName'];
    }

    public function delete_local_image($url){
      unlink(WWW_ROOT . DS . 'img' . DS . $url);
    }

    public function delete($path){
      $Photos = TableRegistry::get('Photos');
      $this->request->allowMethod(['post', 'delete']);
      $photo = $path->regular;
      $thumbnail = $path->thumbnail;
      if ($Photos->delete($path)) {
        $this->delete_image($photo);
        $this->delete_image($thumbnail);
      } else {
        $this->Flash->error(__('The photo could not be deleted. Please, try again.'));
      }
    }

    public function save($post_image, $folder, $widthRegular, $heigthRegular, $widthThumbnail, $heigthThumbnail){
      $Photos = TableRegistry::get($this->tableName);
      $photo = $Photos->newEntity();
      $picture_name = str_replace(' ', '', $folder . '_' . microtime() . '.jpeg');
      $picture = $post_image['regular'];
      if($folder)
        $folder = DS . $folder . DS;
      $post_image['regular'] = $picture_name;
      $post_image['thumbnail'] = '/thumbnail_' . $picture_name;
      $photo = $Photos->patchEntity($photo, $post_image);
      if ($Photos->save($photo)) {
        $this->uploadImage($picture, $picture_name, $folder, $widthRegular, $heigthRegular);
        $this->uploadImage($picture, 'thumbnail_' . $picture_name, $folder, $widthThumbnail, $heigthThumbnail);
        return ['id'=>$photo->id,'regular'=>$photo->regular,'thumbnail'=>$photo->thumbnail];
      }
    }

    private function uploadImage($image, $nombre, $folder, $width, $height) {
      //var_dump($image);die;
      if ($image['error'] == 0) {
        //$image['type'] = 'image/jpeg';
        if ($image['type'] == 'image/jpeg' || $image['type'] == 'image/pjpeg') {
          $path_picture = $this->create_image_jpg($image, $nombre, $width, $height);
          $s3 = TableRegistry::get('S3');
          $content = $s3->putObject($nombre, fopen($path_picture, 'r'));
          $this->delete_local_image($nombre);
        } else {
          if ($image['type'] == 'image/png') {
            $img = $this->create_image_png($image, $nombre, $width, $height);
            $s3 = TableRegistry::get('S3');
            $content = $s3->putObject($nombre, fopen($img, 'r'));
            $this->delete_local_image($nombre);
            return $img;
          } else {
            return '';
          }
        }
      } else {
        return '';
      }
    }

    private function delete_image($path){
      $s3 = TableRegistry::get('S3');
      $content = $s3->deleteObject($path);
      return $content;
    }

    public function create_image_jpg($image, $nombre, $width, $height) {
      $destino = WWW_ROOT . DS . 'img' . DS;
      $new_image = imagecreatefromjpeg($image['tmp_name']);
      if ($new_image) {
        $image = $this->Trin($this->normaliza($nombre));
        imagejpeg($this->image_resize_JPG($new_image, $width, $height), $this->Trin($this->normaliza($destino . $image)), 90);
        return $destino.$image;
      } else {
        echo 'no crea la imagen correctamente';die;
        return '';
      }
    }
    
    public function create_image_png($image, $nombre, $width, $height) {
      $destino = WWW_ROOT . DS . 'img' . DS;
      $nombre = $this->Trin($this->normaliza($nombre));
      $image_resized = $this->image_resize_PNG($image['tmp_name'], $width, $height);
      if ($image_resized) {
        if (imagepng($image_resized, $this->Trin($this->normaliza($destino . $nombre)))) {
          return $destino.$nombre;
        } else {
          return '';
        }
      } else {
        return '';
      }
    }

    public function image_resize_JPG($im, $witdh, $height) {
      //Original sizes
      $ow = imagesx($im);
      $oh = imagesy($im);

      //To fit the image in the new box by cropping data from the image, i have to check the biggest prop. in height and witdh
      if ($witdh / $ow > $height / $oh) {
        $nw = $witdh;
        $nh = ($oh * $nw) / $ow;
        $px = 0;
        $py = ($height - $nh) / 2;
      } else {
        $nh = $height;
        $nw = ($ow * $nh) / $oh;
        $py = 0;
        $px = ($witdh - $nw) / 2;
      }

        //Create a new image witdh requested size
      $new = imagecreatetruecolor($witdh, $height);

        //Copy the image loosing the least space
      imagecopyresampled($new, $im, $px, $py, 0, 0, $nw, $nh, $ow, $oh);

      return $new;
    }
    
    public function image_resize_PNG($src, $witdh, $height) {

      list($w, $h) = getimagesize($src);
      if ($img = imagecreatefrompng($src)) {

        $ratio = min($witdh / $w, $height / $h);
        $witdh = $w * $ratio;
        $height = $h * $ratio;
        $x = 0;

        if ($new = imagecreatetruecolor($witdh, $height)) {
            // preserve transparency
          imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 0));
          imagealphablending($new, false);
          imagesavealpha($new, true);
          imagecopyresampled($new, $img, 0, 0, $x, 0, $witdh, $height, $w, $h);
          return $new;
        } else {
          return '';
        }
      } else {
        return '';
      }
    }

    public function normaliza($cadena) {
      $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
      ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
      $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
      bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
      $cadena = strtolower(strtr(utf8_decode($cadena), utf8_decode($originales), $modificadas));
      return utf8_encode($cadena);
    }
    
    public function trin($cadena) {
      $cadena = preg_replace("([ ]+)", "", $cadena);
      return $cadena;
    }

  }
