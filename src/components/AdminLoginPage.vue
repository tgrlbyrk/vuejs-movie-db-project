<template>
<div id="app">
  <div class="ui middle aligned center aligned grid login_container">
      <div class="column">
        <h2 class="ui orange  header">
          <div class="content">
            Yönetici Girişi
          </div>
        </h2>
        <form class="ui large form" :class="{'error': hasErrors}">
          <div class="ui stacked segment">

            <div class="field">
              <div class="ui left icon input">
                <i class="user icon"></i>
                <input type="text" name="email" placeholder="E-mail adresinizi giriniz" v-model.trim="email" required>
              </div>
            </div>

            <div class="field">
              <div class="ui left icon input">
                <i class="lock icon"></i>
                <input type="password" name="password" placeholder="Parolanızı giriniz" v-model.trim="password" required>
              </div>
            </div>

            <div class="ui fluid large button" @click.prevent="login" :class="{'loading': isLoading}">Giriş</div>
          </div>

          <div class="ui error message" v-if="hasErrors">
            <p v-for="error in errors"> {{error}}</p>
          </div>

        </form>

      </div>
    </div>

</div>
</template>
<script>
  export default {
    name:'register',
    data(){
      return{
        email:'',
        password:'',
        errors: [],
        isLoading: false
      }
    },
    computed:{
      hasErrors(){
        return this.errors.length > 0;
      }
    },
    methods:{
      login(){
        this.errors = []
        if(this.isFormValid){
          this.isLoading = true
          firebase.auth().signInWithEmailAndPassword(this.email, this.password)
            .then((user) =>{
              this.$store.dispatch('setUser', user)
              this.$router.push('/')
            })
            .catch( error => {
              this.errors.push(error.message)
              this.isLoading = false;
            })
        }
      },
      isEmpty(){
        return  this.email.length === 0 || this.password.length === 0 ;
      },
      passwordValid(){
        return this.password.length < 6;
      },
      isFormValid(){
        if(this.isEmpty()){
          this.errors.push('one of the fields is empty');
          return false;
        }
        if(!this.passwordValid()){
          this.erros.push('Passwords mismatch or something');
          return false;
        }
        return true;
      }
    }
  }
</script>
<style scoped>
.login_container{
  margin-top: 40px;
}
.column{
  max-width: 450px;
}
.content {
  color:white;
}
.button {
  background-color: #FFC107;
}
.button:hover {
  background-color: #FF9800;
}

</style>
