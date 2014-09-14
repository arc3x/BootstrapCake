# BootstrapCake Shell Template

BootstrapCake is a shell template for rapidly developing beautiful Bootstrap themed CakePHP applications through the CakePHP console. The default template uses the ugly CakePHP styling but this template makes your app look beautiful by default.

This branch eliminates common programming chores by creating reserved database column 'prefixes'. This also includes a construction area.


## 'Prefix' Usage

* Any column named picture* (eg 'picture_profile') will be treated as an image upload.
 - Controller upload function (make sure to secure for filetypes)
 - Bootstrap Upload 'browse' in view


* Any column named thumbnail* (eg 'thumbnail_profile') will be used to store a thumbnail of an uploaded image (configure in AppController.php).
 - The 'postfix' of the column name must match. (eg iff 'pictureFish' column exists will 'thumbnailFish' thumbnail be generated.
 - Only .jpg thumbnails supported
 

* Any column named fancytext* (eg 'fancytext_bio') will be treated as a WYSIWYG rich text editor. 

## Construction Area
* in 'core.php' the flags 'construction' and 'construction_countdown' can be set to put the site in construction mode.
* in the layout 'construction.ctp' a countdown timer can be configured (at the bottom).


## Requirements

* [CakePHP](http://cakephp.org/) >= 2.3
* [Bootstrap](http://getbootstrap.com/) >= 3.0

## Installation

* Extract the files into the proper directory.

* Start baking! If you've never used the console, here's a great tutorial: [http://book.cakephp.org/2.0/en/console-and-shells/code-generation-with-bake.html](http://book.cakephp.org/2.0/en/console-and-shells/code-generation-with-bake.html)
* Make sure you select the bootstrap template when prompted


## Credits
* Original BootStrapCake [web](http://www.ekoim.com/blog/bootstrap-cakephp-bootstrapcake/)
 [git](https://github.com/EKOInternetMarketing/BootstrapCake)

* Original Summernote [web](http://hackerwins.github.io/summernote/)
