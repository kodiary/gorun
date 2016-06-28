<?php
    //ckeditor with ckfinder
    $this->widget('ext.editor.CKkceditor',array(
        "model"=>$model,                # Data-Model
        "attribute"=>$attribute,        # Attribute in the Data-Model
        "height"=>'200px',
        "width"=>'98%',
        "id"=>'editor',
        'config' => array(
            //'editorTemplate'=>'full',        
                'toolbar'=> array(
                    array( 'Source' ),
                    array( 'Bold', 'Italic', 'Underline', 'Strike','-', 'Subscript', 'Superscript' ),
                    array( 'NumberedList', 'BulletedList' ),
                    array( 'Outdent', 'Indent', 'Blockquote', 'CreateDiv' ),
                    array( 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord' ),
                    array( 'Print', 'SpellChecker', 'Scayt' ),
                    array( 'Undo', 'Redo', '-' , 'Find', 'Replace' ),
                    array( 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak' ),
                    array( 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ),
                    array( 'Link', 'Unlink', 'Anchor' ) ,
                ),
              ),
            "filespath"=>Yii::app()->basePath."/../files/",
            "filesurl"=>Yii::app()->baseUrl."/files/",
    ) );
?>