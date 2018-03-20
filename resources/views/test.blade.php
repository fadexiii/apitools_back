<!DOCTYPE>
<html>
<head>

</head>
<body>

<div id="dd">
    <a>{{$data}}</a>
    <example></example>
    <input v-model="dd">
    <button @click="echo">click</button>
</div>
</body>
</html>
<script src="{{mix('js/app.js')}}"></script>
<script>
    new Vue({
        el: '#dd',
        data: {
            dd: 'a'
        },
        methods: {
            echo() {
                console.log(this.dd)
            }
        }
    })
</script>