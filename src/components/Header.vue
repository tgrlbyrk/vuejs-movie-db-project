<template>
<div id="app">

<nav class="navbar navbar-expand-lg ">
<a class="navbar-brand" href="#">Logo</a>
<button class="navbar-toggler navbar-toggler-right " type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span> </span>
            <span> </span>
            <span> </span>
</button>
<div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <router-link class="nav-link" :to="{ path: '/'}" replace>Ana Sayfa</router-link>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Filmler
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <router-link class="dropdown-item" :to="{ path: '/filmler'}" replace>Tümü</router-link>
        <router-link class="dropdown-item" :to="{ name: 'filmKategori', params: { film_kategorisi: 'aksiyon' }}">Aksiyon</router-link>
        <router-link class="dropdown-item" :to="{ name: 'filmKategori', params: { film_kategorisi: 'animasyon' }}">Animasyon</router-link>
        <router-link class="dropdown-item" :to="{ name: 'filmKategori', params: { film_kategorisi: 'bilimkurgu' }}">Bilim Kurgu</router-link>
        <router-link class="dropdown-item" :to="{ name: 'filmKategori', params: { film_kategorisi: 'dram' }}">Dram</router-link>
        <router-link class="dropdown-item" :to="{ name: 'filmKategori', params: { film_kategorisi: 'fantastik' }}">Fantastik</router-link>
        <router-link class="dropdown-item" :to="{ name: 'filmKategori', params: { film_kategorisi: 'gerilim' }}">Gerilim</router-link>
        <router-link class="dropdown-item" :to="{ name: 'filmKategori', params: { film_kategorisi: 'komedi' }}">Komedi</router-link>
        <router-link class="dropdown-item" :to="{ name: 'filmKategori', params: { film_kategorisi: 'korku' }}">Korku</router-link>
        <router-link class="dropdown-item" :to="{ name: 'filmKategori', params: { film_kategorisi: 'macera' }}">Macera</router-link>
        <router-link class="dropdown-item" :to="{ name: 'filmKategori', params: { film_kategorisi: 'psikolojik' }}">Psikolojik</router-link>
        <router-link class="dropdown-item" :to="{ name: 'filmKategori', params: { film_kategorisi: 'romantik' }}">Romantik</router-link>
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Diziler
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <router-link class="dropdown-item" :to="{ path: '/diziler'}" replace>Tümü</router-link>
        <router-link class="dropdown-item" :to="{ name: 'diziKategori', params: { dizi_kategorisi: 'aksiyon' }}">Aksiyon</router-link>
        <router-link class="dropdown-item" :to="{ name: 'diziKategori', params: { dizi_kategorisi: 'animasyon' }}">Animasyon</router-link>
        <router-link class="dropdown-item" :to="{ name: 'diziKategori', params: { dizi_kategorisi: 'bilimkurgu' }}">Bilim Kurgu</router-link>
        <router-link class="dropdown-item" :to="{ name: 'diziKategori', params: { dizi_kategorisi: 'dram' }}">Dram</router-link>
        <router-link class="dropdown-item" :to="{ name: 'diziKategori', params: { dizi_kategorisi: 'fantastik' }}">Fantastik</router-link>
        <router-link class="dropdown-item" :to="{ name: 'diziKategori', params: { dizi_kategorisi: 'gerilim' }}">Gerilim</router-link>
        <router-link class="dropdown-item" :to="{ name: 'diziKategori', params: { dizi_kategorisi: 'komedi' }}">Komedi</router-link>
        <router-link class="dropdown-item" :to="{ name: 'diziKategori', params: { dizi_kategorisi: 'korku' }}">Korku</router-link>
        <router-link class="dropdown-item" :to="{ name: 'diziKategori', params: { dizi_kategorisi: 'macera' }}">Macera</router-link>
        <router-link class="dropdown-item" :to="{ name: 'diziKategori', params: { dizi_kategorisi: 'psikolojik' }}">Psikolojik</router-link>
        <router-link class="dropdown-item" :to="{ name: 'diziKategori', params: { dizi_kategorisi: 'romantik' }}">Romantik</router-link>
      </div>
    </li>
    <li class="nav-item">
      <router-link class="nav-link" :to="{ path: '/haberler'}" replace>Haberler</router-link>
    </li>

    <li class="nav-item">
      <router-link class="nav-link" :to="{ path: '/hakkimizda'}" replace>Hakkımızda</router-link>
    </li>

    <li class="nav-item">
      <router-link class="nav-link" :to="{ path: '/giris'}" replace>Üye Girişi</router-link>
    </li>
    <li class="nav-item">
      <router-link class="nav-link" :to="{ path: '/kayitol'}" replace>Kayıt Ol</router-link>
    </li>
    <li class="nav-item">
      <router-link class="nav-link" :to="{ path: '/admingiris'}" replace>Yönetici Girişi</router-link>
    </li>

    <li class="nav-item">
      <router-link class="nav-link" v-if="this.$parent.$parent.authenticated" to="/" v-on:click.native="logout()" replace>Çıkış Yap</router-link>
    </li>



  </ul>
</div>
</nav>

</div>
</template>

<script>


export default {
  data() {
    return {

    }
  },
  methods: {
      setAuthenticated(status) {
          this.authenticated = status;
      },
      logout() {
          this.$parent.$parent.authenticated = false;
          this.$parent.$parent.mockAccount[0].user_name = "",
          this.$parent.$parent.mockAccount[0].user_password = ""
      }
  }

}
</script>

<style scoped>



#app {
  display: block;
  width: 100%;
  top: 0;

}
.navbar {
  background-color: #ffd300;
}

.navbar-toggler{
  padding: 10px 5px;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}



li a {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  color: #231F20;
  background-color: #ffd300;
  text-align: center;
  padding: 20px 10px;
  text-decoration: none;
  font-size: 14px;
  font-weight: 500;
}


li a:hover {
  background-color: #FFC107;
}



.navbar-toggler:focus,
.navbar-toggler:active {
    outline: 0;
}

.navbar-toggler span {
   display: block;
   background-color: #444;
   height: 3px;
   width: 25px;
   margin-top: 4px;
   margin-bottom: 4px;
   -webkit-transform: rotate(0deg);
   -moz-transform: rotate(0deg);
   -o-transform: rotate(0deg);
   transform: rotate(0deg);
   position: relative;
   opacity: 1;
}

.navbar-toggler span:nth-child(1),
.navbar-toggler span:nth-child(3) {
   -webkit-transition: transform .35s ease-in-out;
   -moz-transition: transform .35s ease-in-out;
   -o-transition: transform .35s ease-in-out;
   transition: transform .35s ease-in-out;
}

.navbar-toggler:not(.collapsed) span:nth-child(1) {
    position: absolute;

    top: 20px;
    -webkit-transform: rotate(135deg);
    -moz-transform: rotate(135deg);
    -o-transform: rotate(135deg);
    transform: rotate(135deg);
    opacity: 0.9;
}

.navbar-toggler:not(.collapsed) span:nth-child(2) {
    height: 12px;
    visibility: hidden;
    background-color: transparent;
}

.navbar-toggler:not(.collapsed) span:nth-child(3) {
    position: absolute;

    top: 20px;
    -webkit-transform: rotate(-135deg);
    -moz-transform: rotate(-135deg);
    -o-transform: rotate(-135deg);
    transform: rotate(-135deg);
    opacity: 0.9;
}
.navbar-toggler {
     align-self: flex-end;
}

</style>
