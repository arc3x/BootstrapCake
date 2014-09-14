<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'Session',
    );

    public function createThumb( $pathToImage, $pathToThumb, $thumbWidth ) {
        // parse path for the extension
        $info = pathinfo($pathToImage);
        // continue only if this is a JPEG image
        if ( strtolower($info['extension']) == 'jpg' ) {
            // load image and get image size
            $img = imagecreatefromjpeg( "{$pathToImage}" );
            $width = imagesx( $img );
            $height = imagesy( $img );
            // calculate thumbnail size
            $new_width = $thumbWidth;
            $new_height = floor( $height * ( $thumbWidth / $width ) );
            // create a new temporary image
            $tmp_img = imagecreatetruecolor( $new_width, $new_height );
            // copy and resize old image into new image
            imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
            // save thumbnail into a file
            imagejpeg( $tmp_img, "{$pathToThumb}" );
        }
    }



    public function beforeFilter(){
        $this->layout = 'bootstrap';
        if(Configure::read('construction')) {
//***SAMPLE: Allow 'login && allow admins past construction'
//            if($this->request->param('action')!='login') {
//                if($this->Auth->user('role_id')!=2 && $this->Auth->user('role_id')!=3) {
                    $this->layout = 'construction';
//                }
//            }

        }
    }

}

