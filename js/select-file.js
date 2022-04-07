jQuery(function ($) {
    $(document).ready(function () {

        $('body').on('click', '.custom_upload_file_button', function (e) {
            e.preventDefault();

            var button = $(this);
            custom_uploader = wp.media({
                title: 'Додати файл',
                library: { /*  type: 'pdf'*/ },
                button: {
                    text: 'Вибрати' // button label text
                },
                multiple: false // for multiple image selection set to true
            }).on('select', function () { // it also has "open" and "close" events 
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                $(button).prev().attr('href', attachment.url).html(attachment.url).show();
                $(button).next().val(attachment.url);
                $(button).next().next().show();
            })
            .open();
        });

        $('body').on('click', '.custom_clear_file_button', function (e) {
            e.preventDefault();
            var list = $('.company-address-list');
            var item = list.find('.item-address').last().clone();
            
            // убираем значение в скрытом поле
            item.find('input[type=hidden]').attr("value",'');
            
            $(this).prev().prev().prev().hide();
            $(this).prev().val('');
            $(this).hide();
        });

        var $companyInfo = $('.company-info');

        // Добавляет бокс с вводом адреса фирмы
        $('.add-company-address', $companyInfo).click(function () {
            var list = $('.company-address-list');
            var item = list.find('.item-address').last().clone();
            
            // убираем значение в скрытом поле
            item.find('input[type=hidden]').attr("value",'');

            // скрываем ссылку и кнопку удалить
            item.find('a').hide();
            item.find('.remove-company-address').hide();

            list.append(item);
        });

        // Удаляет бокс с вводом адреса фирмы
        $companyInfo.on('click', '.remove-company-address', function () {
            if ($('.item-address').length > 1) {
                $(this).closest('.item-address').remove();
            }
            else {
                $(this).closest('.item-address').find('.custom_file_prev').detach();
                $(this).closest('.item-address').find('input').val('');
            }
        });

    });
});