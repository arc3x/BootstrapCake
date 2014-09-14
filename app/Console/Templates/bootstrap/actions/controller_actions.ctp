<?php
/**
 * Bake Template for Controller action generation.
 *
 * PHP 5
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
 * @package       Cake.Console.Templates.default.actions
 * @since         CakePHP(tm) v 1.3
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>

<?php
if(!function_exists('array_key_exists_wildcard')) {
    function array_key_exists_wildcard ( $array, $search, $return = '' ) {
        $search = str_replace( '\*', '.*?', preg_quote( $search, '/' ) );
        $result = preg_grep( '/^' . $search . '$/i', array_keys( $array ) );
        if ( $return == 'key-value' )
            return array_intersect_key( $array, array_flip( $result ) );
        if(!empty($result))
            return 1;
        else
            return 0;
    }
}

?>





/**
 * <?php echo $admin ?>index method
 *
 * @return void
 */
	public function <?php echo $admin ?>index() {
		$this-><?php echo $currentModelName ?>->recursive = 0;
		$this->set('<?php echo $pluralName ?>', $this->Paginator->paginate());
	}

/**
 * <?php echo $admin ?>view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function <?php echo $admin ?>view($id = null) {
		if (!$this-><?php echo $currentModelName; ?>->exists($id)) {
			throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>'));
		}
		$options = array('conditions' => array('<?php echo $currentModelName; ?>.' . $this-><?php echo $currentModelName; ?>->primaryKey => $id));
		$this->set('<?php echo $singularName; ?>', $this-><?php echo $currentModelName; ?>->find('first', $options));
	}



<?php $compact = array(); ?>
/**
 * <?php echo $admin ?>add method
 *
 * @return void
 */
    public function <?php echo $admin ?>add() {
		if ($this->request->is('post')) {
			$this-><?php echo $currentModelName; ?>->create();
<?php if (array_key_exists_wildcard($fields_flip, 'picture*')): ?>
<?php
                $dir=substr(ROOT, strrpos(ROOT, DS)+1);
                if (array_key_exists_wildcard($fields_flip, 'picture*')) {
                    if(!is_dir(APP.'webroot/img/'.$ucPluralName)) {
                        mkdir(APP.'webroot/img/'.$ucPluralName,0755);
                    }
                }
?>
            if(isset($this->request->data['<?php echo $ucSingularName; ?>']['upload'])) {
                foreach($this->request->data['<?php echo $ucSingularName; ?>']['upload'] as $key => $upload) {
                    $file=$upload;
                    $path=APP.'webroot/img/<?php echo $ucPluralName; ?>/'.$file['name'];

                    while(file_exists($path)) {
                        $r=rand(1,10000);
                        $file['name']=$r.$file['name'];
                        $path=APP.'webroot/img/<?php echo $ucPluralName; ?>/'.$file['name'];
                    }
                    if ($file['error'] == 0) {
                        if (move_uploaded_file($file['tmp_name'], $path)) {
                            $this->request->data['<?php echo $ucSingularName; ?>'][$key]='<?php echo $ucPluralName; ?>/'.$file['name'];;
<?php if (array_key_exists_wildcard($fields_flip, 'thumbnail_*')): ?>
                                if (array_key_exists('thumbnail_'.$key, $this->request->data['<?php echo $ucSingularName; ?>'])) {
                                    $thumb_path=APP.'webroot/img/<?php echo $ucPluralName; ?>/thumbnail_'.$file['name'];
                                    $this->createThumb($path,$thumb_path,200);
                                    $this->request->data['<?php echo $ucSingularName; ?>']['thumbnail_'.$key]='<?php echo $ucPluralName; ?>/thumbnail_'.$file['name'];
                                }
<?php endif; ?>
                        } else {
                            $this->Session->setFlash(__('Something went wrong. Please try again.'));
                            $this->redirect(array('action' => 'index'));
                        }
                    }
                }
            }
<?php endif; ?>
            if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
<?php else: ?>
				return $this->flash(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'), array('action' => 'index'));
<?php endif; ?>
			}
		}
<?php
	foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
		foreach ($modelObj->{$assoc} as $associationName => $relation):
			if (!empty($associationName)):
				$otherModelName = $this->_modelName($associationName);
				$otherPluralName = $this->_pluralName($associationName);
				echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
				$compact[] = "'{$otherPluralName}'";
			endif;
		endforeach;
	endforeach;
	if (!empty($compact)):
		echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
	endif;
?>
	}

<?php $compact = array(); ?>
/**
 * <?php echo $admin ?>edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function <?php echo $admin; ?>edit($id = null) {
		if (!$this-><?php echo $currentModelName; ?>->exists($id)) {
			throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>'));
		}
		if ($this->request->is(array('post', 'put'))) {
            $this-><?php echo $currentModelName; ?>->id = $id;
<?php if (array_key_exists_wildcard($fields_flip, 'picture*')): ?>
            if(isset($this->request->data['<?php echo $ucSingularName; ?>']['upload'])) {
                foreach($this->request->data['<?php echo $ucSingularName; ?>']['upload'] as $key => $upload) {
                    if(!empty($this->request->data['<?php echo $ucSingularName; ?>']['upload'][$key]['name'])) {
                        $file=$upload;
                        $path=str_replace(DS, '/', IMAGES.'<?php echo $ucPluralName; ?>/'.$file['name']);
                        $read=$this-><?php echo $ucSingularName; ?>->read($key);
                        $old_pic=str_replace(DS, '/', IMAGES.$read['<?php echo $ucSingularName; ?>'][$key]);

                        if(file_exists($old_pic)) {
                            unlink($old_pic);
                            $item = $this-><?php echo $currentModelName; ?>->find('first', array(
                                'conditions' => array('<?php echo $currentModelName; ?>.id' => $id)
                            ));
                            if(array_key_exists('thumbnail_'.$key,$item['<?php echo $ucSingularName; ?>'])) {
                                $read_thumb=$this-><?php echo $ucSingularName; ?>->field('thumbnail_'.$key);
                                $old_thumb=str_replace(DS, '/', IMAGES.$read_thumb);
                                if(!empty($old_thumb)) {
                                    if(file_exists($old_thumb)) {
                                        unlink($old_thumb);
                                    }
                                }
                            }
                        }

                        while(file_exists($path)) {
                            $r=rand(1,10000);
                            $file['name']=$r.$file['name'];
                            $path=APP.'webroot/img/<?php echo $ucPluralName; ?>/'.$file['name'];
                        }
                        if ($file['error'] == 0) {
                            if (move_uploaded_file($file['tmp_name'], $path)) {
                                $this->request->data['<?php echo $ucSingularName; ?>'][$key]='<?php echo $ucPluralName; ?>/'.$file['name'];;
<?php if (array_key_exists_wildcard($fields_flip, 'thumbnail_*')): ?>
                                    if (array_key_exists('thumbnail_'.$key, $this->request->data['<?php echo $ucSingularName; ?>'])) {
                                        $thumb_path=IMAGES.'<?php echo $ucPluralName; ?>/thumbnail_'.$file['name'];
                                        $this->createThumb($path,$thumb_path,200);
                                        $this->request->data['<?php echo $ucSingularName; ?>']['thumbnail_'.$key]='<?php echo $ucPluralName; ?>/thumbnail_'.$file['name'];
                                    }
<?php endif; ?>
                            } else {
                                $this->Session->setFlash(__('Something went wrong. Please try again.'));
                                $this->redirect($this->referer());
                            }
                        }
                    }
                }
            }
<?php endif; ?>
			if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'), 'default', array('class' => 'alert alert-success'));
                if (isset($this->request->data['apply'])) {
                    return $this->redirect($this->referer());
                } else {
				    return $this->redirect(array('action' => 'index'));
                }
			} else {
				$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
<?php else: ?>
				return $this->flash(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'), array('action' => 'index'));
<?php endif; ?>
			}
		} else {
			$options = array('conditions' => array('<?php echo $currentModelName; ?>.' . $this-><?php echo $currentModelName; ?>->primaryKey => $id));
			$this->request->data = $this-><?php echo $currentModelName; ?>->find('first', $options);
		}
<?php
		foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
			foreach ($modelObj->{$assoc} as $associationName => $relation):
				if (!empty($associationName)):
					$otherModelName = $this->_modelName($associationName);
					$otherPluralName = $this->_pluralName($associationName);
					echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
					$compact[] = "'{$otherPluralName}'";
				endif;
			endforeach;
		endforeach;
		if (!empty($compact)):
			echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
		endif;
	?>
	}

/**
 * <?php echo $admin ?>delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function <?php echo $admin; ?>delete($id = null) {
		$this-><?php echo $currentModelName; ?>->id = $id;
		if (!$this-><?php echo $currentModelName; ?>->exists()) {
			throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>'));
		}
		$this->request->onlyAllow('post', 'delete');
<?php if (array_key_exists_wildcard($fields_flip, 'picture*')): ?>
        $item = $this-><?php echo $currentModelName; ?>->find('first', array(
            'conditions' => array('<?php echo $currentModelName; ?>.id' => $id)
        ));
        //$base=str_replace(DS, '/', substr(ROOT,0,strrpos(ROOT, DS)));
        foreach($item['<?php echo $currentModelName; ?>'] as $key => $value) {
            if(!empty($value)) {
                if (strpos($key, 'picture') === 0 || strpos($key, 'thumbnail') === 0) {
                    $old_pic=str_replace(DS, '/', IMAGES.$value);
                    if(file_exists($old_pic)) {
                        unlink($old_pic);
                    }
                }
            }
        }
<?php endif; ?>
		if ($this-><?php echo $currentModelName; ?>->delete()) {
<?php if ($wannaUseSession): ?>
			$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The <?php echo strtolower($singularHumanName); ?> could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
<?php else: ?>
			return $this->flash(__('The <?php echo strtolower($singularHumanName); ?> has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The <?php echo strtolower($singularHumanName); ?> could not be deleted. Please, try again.'), array('action' => 'index'));
		}
<?php endif; ?>
	}
