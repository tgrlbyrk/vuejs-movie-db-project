<template>
<div id="app">
  <div class="container-fluid pb-4 pt-4 paddding">
  <div class="container paddding">
      <div class="row mx-0">
          <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft">
              <div>
                  <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Haberler</div>
              </div>
              <div v-for="oneNews in news" class="row pb-4">
                  <div class="col-md-5">
                      <div class="fh5co_hover_news_img">
                          <div class="fh5co_news_img"><img :src="oneNews.news_photo" alt=""/></div>
                          <div></div>
                      </div>
                  </div>
                  <div class="col-md-7 animate-box">
                      <a href="single.html" class="fh5co_magna py-2"> {{oneNews.news_title}} </a> <a href="single.html" class="fh5co_mini_time py-3"> {{oneNews.news_date}} </a>
                      <div class="fh5co_consectetur"> {{oneNews.news_description | slice}}...
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-md-3 animate-box" data-animate-effect="fadeInRight">
              <div>
                  <div class="fh5co_heading fh5co_heading_border_bottom pt-3 py-2 mb-4">En Popüler</div>
              </div>
              <div v-for="oneMostViewedNews in mostViewedNews" class="row pb-3">
                  <div class="col-5 align-self-center">
                      <img :src="oneMostViewedNews.news_photo" alt="img" class="fh5co_most_trading"/>
                  </div>
                  <div class="col-7 paddding">
                      <div class="most_fh5co_treding_font">  <h6>{{oneMostViewedNews.news_title}}</h6>  </div>
                      <div class="most_fh5co_treding_font_123">{{oneMostViewedNews.news_date}}</div>
                  </div>
              </div>
          </div>
      </div>
      <div class="row mx-0 animate-box" data-animate-effect="fadeInUp">
          <div class="col-12 text-center pb-4 pt-4">
              <a href="#" class="btn_mange_pagging"><i class="fa fa-long-arrow-left"></i>&nbsp;&nbsp; Önceki</a>
              <a href="#" v-for="page in totalPages" v-on:click="paging(page)" class="btn_pagging">{{page}}</a>
              <a href="#" class="btn_mange_pagging">Sonraki <i class="fa fa-long-arrow-right"></i>&nbsp;&nbsp; </a>
           </div>
      </div>
  </div>
</div>
</div>
</template>

<script>
export default {
  data() {
    return {
      news: [],
      mostViewedNews: [],
      totalPages: 1
    };
  },
  filters: {
    slice: function(value) {
      if (!value) return "";
      value = value.slice(0, 300);
      return value;
    }
  },
  methods: {
    paging: function(page) {
      this.$http
        .get("http://localhost:8888/api/api.php?getNews&pageNumber=" + page)
        .then(function(data) {
          this.news = data.body;
        });
    }
  },
  created() {
    this.$http
      .get("http://localhost:8888/api/api.php?getTotalPageNumberNews")
      .then(function(data) {
        console.log(data);
        this.totalPages = Number(data.body);
      });
    this.$http
      .get("http://localhost:8888/api/api.php?getNews")
      .then(function(data) {
        this.news = data.body;
      });
    this.$http
      .get("http://localhost:8888/api/api.php?getMostViewed5NewsForMoviePage")
      .then(function(data) {
        this.mostViewedNews = data.body;
      });
  }
};
</script>

<style scoped>
.col-md-8 {
  -webkit-box-flex: 0;
  -webkit-flex: 0 0 66.666667%;
  -ms-flex: 0 0 66.666667%;
  flex: 0 0 66.666667%;
  max-width: 66.666667%;
}

.js .animate-box {
  opacity: 0;
}

.fh5co_heading {
  font-size: 20px;
  color: #424040;
}
.fh5co_heading {
  font-size: 24px;
  color: #222;
}
.fh5co_heading_border_bottom {
  border-bottom: 1px solid #777;
}

.py-2 {
  padding-top: 0.5rem !important;
  padding-bottom: 0.5rem !important;
}

.mb-4 {
  margin-bottom: 1.5rem !important;
}

.row {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-flex-wrap: wrap;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px;
}

@media (min-width: 576px) {
  .row {
    margin-right: -15px;
    margin-left: -15px;
  }
}

@media (min-width: 768px) {
  .row {
    margin-right: -15px;
    margin-left: -15px;
  }
}

@media (min-width: 992px) {
  .row {
    margin-right: -15px;
    margin-left: -15px;
  }
}

@media (min-width: 1200px) {
  .row {
    margin-right: -15px;
    margin-left: -15px;
  }
}
.pb-4 {
  padding-bottom: 1.5rem !important;
}
.col-md-5 {
  -webkit-box-flex: 0;
  -webkit-flex: 0 0 41.666667%;
  -ms-flex: 0 0 41.666667%;
  flex: 0 0 41.666667%;
  max-width: 41.666667%;
}

.fh5co_hover_news_img:hover > .fh5co_news_img {
  top: -7px;
  -webkit-box-shadow: inset 0 2px 3px 1px;
  -moz-box-shadow: inset 0 2px 3px 1px;
  -o-box-shadow: inset 0 2px 3px 1px;
  box-shadow: inset 0 2px 3px 1px;
}

.fh5co_news_img {
  height: 200px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  -ms-border-radius: 5px;
  border-radius: 5px;
  overflow: hidden;
  position: relative;
  top: 0;
  -webkit-box-shadow: inset 0 2px 3px 1px;
  -moz-box-shadow: inset 0 2px 3px 1px;
  -o-box-shadow: inset 0 2px 3px 1px;
  box-shadow: inset 0 2px 3px 1px;
  -moz-transition: all all 0.5s ease;
  -o-transition: all all 0.5s ease;
  -webkit-transition: all all 0.5s ease;
  -ms-transition: all all 0.5s ease;
  transition: all all 0.5s ease;
}

.fh5co_news_img > img {
  height: 260px;
  min-width: 100%;
}
.col-md-7 {
  -webkit-box-flex: 0;
  -webkit-flex: 0 0 58.333333%;
  -ms-flex: 0 0 58.333333%;
  flex: 0 0 58.333333%;
  max-width: 58.333333%;
}
.fh5co_magna {
  font-size: 16px;
  color: #222 !important;
  font-weight: 800;
}
.py-2 {
  padding-top: 0.5rem !important;
  padding-bottom: 0.5rem !important;
}
.fh5co_mini_time {
  font-size: 14px;
  color: #222;
  display: inline-block;
}
.py-3 {
  padding-top: 1rem !important;
  padding-bottom: 1rem !important;
}
.fh5co_consectetur {
  font-size: 14px;
  color: #777;
}

.container-fluid {
  position: relative;
  margin-left: auto;
  margin-right: auto;
  padding-right: 15px;
  padding-left: 15px;
}

@media (min-width: 576px) {
  .container-fluid {
    padding-right: 15px;
    padding-left: 15px;
  }
}

@media (min-width: 768px) {
  .container-fluid {
    padding-right: 15px;
    padding-left: 15px;
  }
}

@media (min-width: 992px) {
  .container-fluid {
    padding-right: 15px;
    padding-left: 15px;
  }
}

@media (min-width: 1200px) {
  .container-fluid {
    padding-right: 15px;
    padding-left: 15px;
  }
}
.pb-4 {
  padding-bottom: 1.5rem !important;
}
.pt-4 {
  padding-top: 1.5rem !important;
}
.paddding {
  padding-left: 0 !important;
  padding-right: 0 !important;
}

.container {
  position: relative;
  margin-left: auto;
  margin-right: auto;
  padding-right: 15px;
  padding-left: 15px;
}

@media (min-width: 576px) {
  .container {
    padding-right: 15px;
    padding-left: 15px;
  }
}

@media (min-width: 768px) {
  .container {
    padding-right: 15px;
    padding-left: 15px;
  }
}

@media (min-width: 992px) {
  .container {
    padding-right: 15px;
    padding-left: 15px;
  }
}

@media (min-width: 1200px) {
  .container {
    padding-right: 15px;
    padding-left: 15px;
  }
}

@media (min-width: 576px) {
  .container {
    width: 540px;
    max-width: 100%;
  }
}

@media (min-width: 768px) {
  .container {
    width: 720px;
    max-width: 100%;
  }
}

@media (min-width: 992px) {
  .container {
    width: 960px;
    max-width: 100%;
  }
}

@media (min-width: 1200px) {
  .container {
    width: 1140px;
    max-width: 100%;
  }
}
.mx-0 {
  margin-right: 0 !important;
  margin-left: 0 !important;
}

.col-md-3 {
  -webkit-box-flex: 0;
  -webkit-flex: 0 0 25%;
  -ms-flex: 0 0 25%;
  flex: 0 0 25%;
  max-width: 25%;
}
.clearfix::after {
  display: block;
  content: "";
  clear: both;
}

.fh5co_tagg {
  background: #f1f1f1;
  padding: 10px 15px;
  color: #222;
  -moz-transition: all 0.5s ease;
  -o-transition: all 0.5s ease;
  -webkit-transition: all 0.5s ease;
  -ms-transition: all 0.5s ease;
  transition: all 0.5s ease;
  margin-right: 8px;
  margin-top: 5px;
  margin-bottom: 5px;
  display: inline-block;
}

.fh5co_tagg:hover,
.fh5co_tagg:focus {
  background: #f5bc04;
  color: #fff;
  text-decoration: none;
}

.pt-3 {
  padding-top: 1rem !important;
}
.mb-4 {
  margin-bottom: 1.5rem !important;
}

.align-self-center {
  -webkit-align-self: center !important;
  -ms-flex-item-align: center !important;
  -ms-grid-row-align: center !important;
  align-self: center !important;
}

.fh5co_most_trading {
  height: 60px;
  width: 100%;
}

.text-center {
  text-align: center !important;
}

.btn_mange_pagging {
  background: #f1f1f1;
  padding: 12px 5px;
  color: #222 !important;
  font-weight: 800;
  margin: 0 5px;
  transition: 0.5s;
  font-size: 12px;
}
.btn_pagging {
  background: #f1f1f1 !important;
  color: #222;
  padding: 12px 10px !important;
  font-weight: 800;
  margin: 0 5px;
  transition: 0.5s;
  font-size: 12px;
}
.btn_mange_pagging:hover,
.btn_mange_pagging:focus {
  background: #222;
  color: #fff !important;
  font-weight: 800;
}
.btn_pagging:hover,
.btn_pagging:focus {
  background: #222 !important;
  color: #fff;
}

#app {
  background-color: #ffffff;
}
</style>
