jQuery(function($) {
    $('#wp-admin-bar-generate-sitemap .ab-item').on('click', function(e) {
        e.preventDefault();

        var $this = $(this);
        var $message = $('<span class="generate-sitemap-message"></span>');
        $this.append($message);

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'generate_sitemap_ajax',

            },
            beforeSend: function() {
                $this.addClass('generate-sitemap-loading').text('Generating...');
            },
            success: function(data) {
                $this.removeClass('generate-sitemap-loading').text('Generated');
                $message.text('Sitemap generated successfully.');
            },
            error: function(xhr) {
                $this.removeClass('generate-sitemap-loading').text('Error');
                $message.text('An error occurred while generating the sitemap.');
            },
        });
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'generate_sitemap_ajax1',
                
            },
            beforeSend: function() {
                $this.addClass('generate-sitemap-loading').text('Generating...');
            },
            success: function(data) {
                $this.removeClass('generate-sitemap-loading').text('Generated');
                $message.text('Sitemap generated successfully.');
            },
            error: function(xhr) {
                $this.removeClass('generate-sitemap-loading').text('Error');
                $message.text('An error occurred while generating the sitemap.');
            },
        });
    });
});

