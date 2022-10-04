
//anotacoes

    const div = document.getElementById('parent')
    const button = document.getElementById('btn1')
    const php = document.getElementById('php')
    var id = "id" + Math.random().toString(16).slice(2)

      renderScreen()
        function renderScreen(){

            $(function(){
                $(".wrapper").draggable();
            });
            $('.wrapper').mousedown(function() {
                $(this).siblings('.wrapper').css('z-index', 10);
                $(this).css('z-index', 11);
            });
            requestAnimationFrame(renderScreen)
        }
