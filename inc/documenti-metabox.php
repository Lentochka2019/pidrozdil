<?php
/*Документы*/
/*Добавляем документы в подразделение*/

// с таким ключем будем хранить документы в базе
define('PIDROZDIL_DOCUMENTI_META_ID', 'documenti');

function pidrozdil_docs_meta_box()
{
    add_meta_box(
        'pidrozdil_docs_meta_box', // Идентификатор(id)
        'Документи підрозділу', // Заголовок области с мета-полями(title)
        'pidrozdil_documenti_show_metabox', // Вызов(callback)
        'pidrozdily', // Где будет отображаться наше поле, в нашем случае в разделе 
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'pidrozdil_docs_meta_box'); // Запускаем функцию  

$pidrozdil_meta_fields1 = array(
  

    array(
        'label' => 'Ссылка на файл',
        'desc'  => '',
        'id'    => 'order2', // даем идентификатор.
        'type'  => 'file'  // Указываем тип поля.
    )
    
);


function pidrozdil_documenti_show_metabox()
{
    global $pidrozdil_meta_fields1; // Обозначим наш массив с полями глобальным
    //print_r($specialty_meta_fields);
    global $post;  // Глобальный $post для получения id создаваемого/редактируемого поста
    // Выводим скрытый input, для верификации. Безопасность прежде всего!
    echo '<input type="hidden" name="custom_meta_box_nonce" value="' . wp_create_nonce(basename(__FILE__)) . '" />';

    // Начинаем выводить таблицу
    echo '<table class="form-table company-info">';
    echo '<tr>';
    echo '<th>';
    echo '<label>Ссылка на файл</label>&nbsp;';
    echo '<span class="dashicons dashicons-plus-alt add-company-address"></span>';
    echo '</th>';
    echo '<td class="company-address-list">';

    // получим метаполя документов, которые были сохранены ранее (если они есть)
    $oldMetas = get_post_meta($post->ID, PIDROZDIL_DOCUMENTI_META_ID, false);
    foreach ($oldMetas as $om) {
        // выводим блоки item-address с уже добавленными документами
        pidrozdil_documenti_form_body($om);
    }
    // и один пустой
    pidrozdil_documenti_form_body('');

    echo '</td></tr>';
    echo '</table>';
}

function pidrozdil_documenti_form_body($meta){
    // видимо на доработку плагина
    // <span class="description">$field['desc']</span>
    ?>
    <!-- Файл, подключенный из медиа -->
    <div class="item-address">
        <a style="display:<?= $meta ? 'inline' : 'none' ?>" href="<?= $meta ?>" class="custom_file_prev"><?= $meta ?></a>
        <button style="display:block;margin:5px 0" class="custom_upload_file_button button">Выберите файл</button>
        <input type="hidden" name="documenti[]" value="<?= $meta ?>" />
        <span style="display:<?= $meta ? 'inline' : 'none' ?>" class="dashicons dashicons-trash remove-company-address"></span>
        <br clear="all" />
    </div>
    <?php
}

function pidrozdil_documenti_save($post_id)
{
    // для отладки :)
	// wp_die(print_r(get_post_meta($post_id, PIDROZDIL_DOCUMENTI_META_ID, false)));

    // проверяем наш проверочный код
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
        return $post_id;
    // Проверяем авто-сохранение
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    // Проверяем права доступа  
    if ('pidrozdil' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    // если метаданных документов нет - выходим
    // здесь мы специально не использовали константу PIDROZDIL_DOCUMENTI_META_ID,
    // потому что $_POST['documenti'] - это то что нам передал JavaScript (могли быть не documenti, а vodkamenti, например)
    if (empty($_POST['documenti'])) 
        return;

    $docsNew = $_POST['documenti']; // из JavaScript
    $docsOld = get_post_meta($post_id, PIDROZDIL_DOCUMENTI_META_ID, false); // из Wordpress

    // Удалим те документы, которые есть в старых (Wordpress), но нет в новых (JavaScript)
    foreach ($docsOld as $do){
        // этот документ есть в обоих массивах, пропускаем
        if (in_array($do, $docsNew)) continue;

        // в новом массиве этого документа нет, удаляем
        delete_post_meta($post_id, PIDROZDIL_DOCUMENTI_META_ID, $do);
    }

     // Добавим те документы, которые есть в новых, но нет в старых
    foreach ($docsNew as $dn){

        if (empty($dn)) continue;
        // если этот документ уже был, то ничего делать не нужно - переходим к следующему 
        if(in_array($dn, $docsOld)) continue;

        // сохраним каждый документ как отдельную запись метаданных
        add_post_meta($post_id, PIDROZDIL_DOCUMENTI_META_ID, $dn);
    }
}
add_action('save_post', 'pidrozdil_documenti_save');