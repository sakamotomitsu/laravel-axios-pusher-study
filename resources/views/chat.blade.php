<html>
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="chat">
  <textarea v-model="message"></textarea>
  <br>
  <button type="button" @click="send()">送信</button>

  <div v-for="m in messages">

    <!-- 登録された日時 -->
    <span v-text="m.created_at"></span>：&nbsp;

    <!-- メッセージ内容 -->
    <span v-text="m.body"></span>

  </div>
</div>
<script src="/public/js/app.js"></script>
<script>

  new Vue({
    el: '#chat',
    data: {
      message: '',
      messages: []
    },

    mounted() {
      this.getMessages();
    },

    methods: {
      getMessages() {

        const url = '/public/ajax/chat';
        axios.get(url)
        .then((response) => {

          this.messages = response.data;

        });

      },

      send() {

        const url = '/public/ajax/chat';
        const params = { message: this.message };
        axios.post(url, params)
        .then((response) => {

          // 成功したらメッセージをクリア
          this.message = '';

        });

      }
    }
  });

</script>
</body>
</html>