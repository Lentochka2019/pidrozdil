<?php

/*Добавляем значения в подразделение*/
function pidrozdil_history_meta_box()
{
    add_meta_box(
        'pidrozdil_history_meta_box', // Идентификатор(id)
        'Історія', // Заголовок области с мета-полями(title)
        'show_history_metabox', // Вызов(callback)
        'pidrozdily', // Где будет отображаться наше поле, в нашем случае в разделе 
        'normal',
        'high'
    );
   
}

add_action('add_meta_boxes', 'pidrozdil_history_meta_box'); // Запускаем функцию  


$pidrozdil_meta_fields = array(

   array(
        'label' => 'Історія',
        'desc'  => '',
        'id'    => 'small_title', // даем идентификатор.
        'type'  => 'textarea'  // Указываем тип поля.
    )
    
);

function show_history_metabox()
{
    global $pidrozdil_meta_fields; // Обозначим наш массив с полями глобальным
    //print_r($specialty_meta_fields);
    global $post;  // Глобальный $post для получения id создаваемого/редактируемого поста
    // Выводим скрытый input, для верификации. Безопасность прежде всего!
    echo '<input type="hidden" name="custom_meta_box_nonce1" value="' . wp_create_nonce(basename(__FILE__)) . '" />';

    // Начинаем выводить таблицу с полями через цикл
    echo '<table class="form-table">';
    foreach ($pidrozdil_meta_fields as $field) {
        // Получаем значение если оно есть для этого поля
        $meta = get_post_meta($post->ID, $field['id'], true);
        // Начинаем выводить таблицу
        echo '
        <tr>
            <th><label for="' . $field['id'] . '">' . $field['label'] . '</label></th>
            <td>';
        switch ($field['type']) {
                //checkbox
            case 'checkbox':
                echo '
            <input type="checkbox" name="' . $field['id'] . '" id="' . $field['id'] . '" ', $meta ? ' checked="checked"' : '', '/>
            <label for="' . $field['id'] . '">' . $field['desc'] . '</label>';
                echo $meta;
                break;

                // Текстовое поле
            case 'text':
                echo '
            <input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="100" />
            <br /><span class="description">' . $field['desc'] . '</span>';
                break;

                // Список
            case 'select':
                echo '<select name="' . $field['id'] . '" id="' . $field['id'] . '">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="' . $option['value'] . '">' . $option['label'] . '</option>';
                }
                echo '
            </select>
            <br /><span class="description">' . $field['desc'] . '</span>';
                break;

            case 'file':  ?>
                <!-- Файл, подключенный из медиа -->
                <div>
				<?echo $meta;?>
                    <a style="display:<?= $meta ? 'inline' : 'none' ?>" href="<?= $meta ?>" class="custom_file_prev"><?= $meta ?></a>
                    <button style="display:block;margin:5px 0" class="custom_upload_file_button button">Выберите файл</button>
                    <input type="hidden" name="<?= $field['id'] ?>" id="<?= $field['id'] ?>" value="<?= $meta ?>" />
                    <a style="display:<?= $meta ? 'inline' : 'none' ?>" href="#" class="custom_clear_file_button">Убрать файл</a>
                    <br clear="all" /><span class="description"><?= $field['desc'] ?></span>
                </div>
                <?php 
            break;
        }
        echo '</td></tr>';
    }
    echo '</table>';
}

function save_pidrozdil($post_id)
{
    global $pidrozdil_meta_fields;  // Массив с нашими полями

   global $post;  // Глобальный $post для получения id создаваемого/редактируемого поста
    // проверяем наш проверочный код
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce1'], basename(__FILE__)))
        return $post_id;
	else echo"Error1";
    // Проверяем авто-сохранение
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
	else echo"Error2";
    // Проверяем права доступа  
    if ('pidrozdil' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
		echo"Error3";
        return $post_id;
    }

    // Если все отлично, прогоняем массив через foreach
    foreach ($pidrozdil_meta_fields as $field) {
        $old = get_post_meta($post_id, $field['id'], true); // Получаем старые данные (если они есть), для сверки
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {  // Если данные новые
            update_post_meta($post_id, $field['id'], $new); // Обновляем данные
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old); // Если данных нету, удаляем мету.
        }
    } // end foreach  
}
add_action('save_post', 'save_pidrozdil');
