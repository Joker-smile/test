<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后端界面</title>
    <meta name=viewport content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
</head>
<body>
<button class="push" data-func="pushHomeLogic">按钮1</button>
<button class="push" data-func="pushListLogic">按钮2</button>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>

<script>
    $(function () {
        $(".push").on('click',function(){
            var func = $(this).attr('data-func').trim();
            ajaxGet(func)
        })
        function ajaxGet(func) {
            url = "{{route('back')}}";
            token = "{{csrf_token()}}";
            $.ajax({
                url: url,
                type: 'post',
                dataType: "json",
                data:{func:func,_token:token},
                error: function (data) {
                    alert("服务器繁忙, 请联系管理员！");
                    return;
                },
                success: function (result) {

                },
            })
        }

    })
</script>
</html>
