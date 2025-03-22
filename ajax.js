(function($){
    $(document).ready(function(){
        $("#clickMe").click(function(){
            $.ajax({
                url : ajax_object.ajax_url,
                type : 'POST',
                data : {
                    action : 'random_post',
                },
                beforeSend: function() {
                    $('#random-post-result').html('<p>Loading...</p>');
                },
                success : function(response) {
                    if (response.success) {
                        let post = response.data;
                        let output = `<h3><a href="${post.link}">${post.title}</a></h3><p>${post.content}</p>`;
                        $('#random-post-result').html(output);
                    } else {
                        $('#random-post-result').html('<p>' + response.data.message + '</p>');
                    }
                }
            });
        });
    });
})(jQuery)