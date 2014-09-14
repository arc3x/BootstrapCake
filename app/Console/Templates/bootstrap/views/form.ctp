<?php
/**
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
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!--?php debug( $schema); ?-->

<div class="<?php echo $pluralVar; ?> form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php printf("<?php echo __('%s %s'); ?>", Inflector::humanize($action), $singularHumanName); ?></h1>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading">Actions</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">

							<?php if (strpos($action, 'add') === false): ?>
    <li><?php echo "<?php echo \$this->Form->postLink(__('<span class=\"glyphicon glyphicon-remove\"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', \$this->Form->value('{$modelClass}.{$primaryKey}')), array('escape' => false), __('Are you sure you want to delete # %s?', \$this->Form->value('{$modelClass}.{$primaryKey}'))); ?>"; ?></li>
							<?php endif; ?>
    <li><?php echo "<?php echo \$this->Html->link(__('<span class=\"glyphicon glyphicon-list\"></span>&nbsp;&nbsp;List " . $pluralHumanName . "'), array('action' => 'index'), array('escape' => false)); ?>"; ?></li>
							<?php /*
									$done = array();
									foreach ($associations as $type => $data) {
										foreach ($data as $alias => $details) {
											if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
												echo "\t\t\t\t\t\t\t\t<li><?php echo \$this->Html->link(__('<span class=\"glyphicon glyphicon-list\"></span>&nbsp;&nbsp;List " . Inflector::humanize($details['controller']) . "'), array('controller' => '{$details['controller']}', 'action' => 'index'), array('escape' => false)); ?> </li>\n";
												echo "\t\t\t\t\t\t\t\t<li><?php echo \$this->Html->link(__('<span class=\"glyphicon glyphicon-plus\"></span>&nbsp;&nbsp;New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add'), array('escape' => false)); ?> </li>\n";
												$done[] = $details['controller'];
											}
										}
									}
							*/ ?>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
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
            //debug($fields);
            $fields_flip=array_flip($fields);
            if (array_key_exists_wildcard($fields_flip, 'picture*')) {
                echo "\t\t\t<?php echo \$this->Form->create('{$modelClass}', array('role' => 'form', 'type' => 'file')); ?>\n\n";
            } else {
                echo "\t\t\t<?php echo \$this->Form->create('{$modelClass}', array('role' => 'form')); ?>\n\n";
            }
?>
<?php
$fancyFlag=0;
		foreach ($fields as $field) {
			if (strpos($action, 'add') !== false && $field == $primaryKey) {
				continue;
			} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
                    echo "\t\t\t\t<div class=\"form-group\">\n";
                    if (strpos($field, 'picture') === 0) {
                        /*echo "\t\t\t\t\t<?php if(isset(\$this->request->data['{$ucSingularVar}']['{$field}']) && !empty(\$this->request->data['{$ucSingularVar}']['{$field}'])): ?>\n";*/
                            /*echo "\t\t\t\t\t\t<?php echo \$this->Form->input('{$ucSingularVar}.upload.{$field}', array('type' => 'file', 'label' => '".Inflector::humanize($field)."&nbsp;('.substr(\$this->request->data['{$ucSingularVar}']['{$field}'],strrpos(\$this->request->data['{$ucSingularVar}']['{$field}'], '/')+1).')', 'placeholder' => '".Inflector::humanize($field)."'));?>\n";*/
                            /*echo "\t\t\t\t\t\t<img class=\"img-responsive img-thumbnail\" style=\"height:50px;\" src=\"<?php echo \$this->request->data['{$ucSingularVar}']['{$field}']; ?>\">\n";*/
                            echo '
                                <?php if (isset($this->request->data[\''.$ucSingularVar.'\'][\''.$field.'\'])): ?>
                                    <label for="'.$field.'_cover">'.Inflector::humanize($field).'&nbsp;(<?php echo substr($this->request->data[\''.$ucSingularVar.'\'][\''.$field.'\'],strrpos($this->request->data[\''.$ucSingularVar.'\'][\''.$field.'\'], \'/\')+1); ?>)</label>
                                <?php else: ?>
                                    <label for="'.$field.'_cover">'.Inflector::humanize($field).'&nbsp;()</label>
                                <?php endif; ?>
                                <input id="'.$field.'" type="file" name="data['.$ucSingularVar.'][upload]['.$field.']" style="display:none">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button id="'.$field.'_browse" onclick="$(\'input[id='.$field.']\').click();" class="btn btn-default" type="button"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Browse...</button>
                                        <button id="'.$field.'_clear" onclick="$(this).'.$field.'_clear();" class="btn btn-default" type="button" style="display: none;"><span style="top:2px;" class="glyphicon glyphicon-remove-sign"></span>&nbsp;&nbsp;Clear</button>
                                    </span>
                                    <input id="'.$field.'_cover" type="text" class="form-control" disabled="disabled">
                                </div>
                                <script type="text/javascript">
                                    $(\'input[id='.$field.']\').change(function() {
                                        $(\'#'.$field.'_cover\').val($(this).val());
                                        $(\'#'.$field.'_browse\').hide();
                                        $(\'#'.$field.'_clear\').show();
                                        $(\'#'.$field.'_clear\').focus();
                                    });
                                (function( $ ){
                                    $.fn.'.$field.'_clear = function() {
                                        var input = $("#'.$field.'");
                                        input.replaceWith(input.val(\'\').clone(true));
                                        $(\'#'.$field.'_cover\').val("");
                                        $(\'#'.$field.'_browse\').show();
                                        $(\'#'.$field.'_browse\').focus();
                                        $(\'#'.$field.'_clear\').hide();
                                        return this;
                                    };
                                })( jQuery );
                                </script>

                            ';
                        /*echo "\t\t\t\t\t<?php else: ?>\n";
                            echo "\t\t\t\t\t\t<?php echo \$this->Form->input('{$ucSingularVar}.upload.{$field}', array('type' => 'file', 'placeholder' => '".Inflector::humanize($field)."'));?>\n";
                        echo "\t\t\t\t\t<?php endif; ?>\n";*/
                    } else if (strpos($field, 'thumbnail') === 0) {
                        echo "\t\t\t\t\t<?php echo \$this->Form->input('{$ucSingularVar}.{$field}', array('type' => 'hidden', 'placeholder' => '".Inflector::humanize($field)."'));?>\n";
                    } else if ($schema[$field]['type']=='text' && strpos($field, 'fancytext')===0) {
                        $new_field=substr($field,10);
                        echo "\t\t\t\t\t<?php echo \$this->Form->input('{$new_field}', array('class' => 'form-control fancytext', 'placeholder' => '".Inflector::humanize($field)."'));?>\n";
                        if($fancyFlag==0) {
                            $fancyFlag=1;
                            echo '
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $(\'.fancytext\').summernote();
                                    });
                                </script>
                            ';
                        }
                    } else {
                        echo "\t\t\t\t\t<?php echo \$this->Form->input('{$field}', array('class' => 'form-control', 'placeholder' => '".Inflector::humanize($field)."'));?>\n";
                    }
                    echo "\t\t\t\t</div>\n";
			}
		}
		if (!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
				echo "\t\t\t\t<div class=\"form-group\">\n";
				echo "\t\t\t\t\t<?php echo \$this->Form->input('{$assocName}', array('class' => 'form-control', 'placeholder' => '".Inflector::humanize($field)."'));?>\n";
				echo "\t\t\t\t</div>\n";
			}
		}
?>
<?php
				echo "\t\t\t\t<div class=\"form-group\">\n";
                echo "\t\t\t\t\t<div class=\"submit\">\n";
				echo "\t\t\t\t\t\t<?php echo \$this->Form->submit(__('Submit'), array('name' => 'data[submit]', 'class' => 'btn btn-default', 'div' => false)); ?>\n";
                if (strpos($action, 'edit') !== false) {echo "\t\t\t\t\t\t<?php echo \$this->Form->submit(__('Apply'), array('name' => 'data[apply]', 'class' => 'btn btn-default', 'div' => false, 'style' => 'margin-left:10px;')); ?>\n";}
                echo "\t\t\t\t\t</div>\n";
				echo "\t\t\t\t</div>\n\n";

			echo "\t\t\t<?php echo \$this->Form->end() ?>\n\n";

?>
		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
