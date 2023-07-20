<template>
  <div :class="view == 'map' ? 'mapView' : 'listView'">
    <div id="grid">
      <ul></ul>
    </div>


    <div id="mainContent">
      <header>
        <a href="#">I loooove Ixelles</a>
        <a class="instalink" href="instagram">Insta</a>
      </header>

      <div class="pageColumns">
        <div id="searchForm">
          <form method="GET" action="#">
            <input type="text" name="search" placeholder="find">
          </form>
        </div>


        <aside>
          <div id="switchView">

            <a @click="view = 'map'" class="actionMap">Map</a> <a @click="view = 'list'" class="actionList">Liste</a>


          </div>
          <div id="ixellesMap">
            <div>
              <img src="/storage/image/map.svg" />
             <ul>
                <li v-for="item in locations" :key="item.id" class="dot" :style="{ left: item.coordX + '%', top: item.coordY + '%' }">{{ item.coordX }} <span> 
                  <a @click="getActivelocation(item.id), changeMapPosition(item.coordX,item.coordY)">  {{ item.name }} </a></span></li>
                </ul>   
              
            </div>
          </div>
          <div id="filters" v-if="isv2">
            <ul>
              <li v-for="item in tags" :key="item.id" >{{ item.title }}</li>
            </ul>
          </div>
          <div id="locationsList">
            
            <ul>
              <li v-for="item in locations" :key="item.id"> <a @click="getActivelocation(item.id)"> {{ item.name }} </a>
              </li>
            </ul>
          </div>
        </aside>
        <main>
          <img v-if="isWelcome" src="/storage/image/coffee.gif" />

          <div v-else>
          <div class="text">
            <h2>{{ activelocation.name }}</h2>

            <!-- @foreach($article -> tags as $tag)
            $tag->title
            @endforeach -->

          </div>


          <img v-if="activelocation.path"
          :src="'storage/'+activelocation.path"
          ><br />

          <div class="specialLink">
            <a @click="blablaOpen = !blablaOpen" class="blabla">BlaBla</a>

          </div>
          <div class="blablacontent" v-if="blablaOpen">
            <span class="close" @click="blablaOpen = false"></span>
            {{ activelocation.description }}
          </div>

        </div>

        </main>

      </div>
    </div>

  </div>

  <TopHeader />
</template>
<script>
import TopHeader from './TopHeader.vue'
import axios from 'axios';

export default {
  components: {
    TopHeader
  },
  mounted() {
    axios.get('/admin/jsonlocations').then((response) => {
      this.locations = response.data
    }),
    axios.get('/admin/jsontags').then((response) => {
      this.tags = response.data
    })
  },
  methods: {
    getActivelocation(q) {
      axios.get('/admin/jsonlocation/' + q).then((response) => {
        this.activelocation = response.data
      }),
      this.isWelcome = false
    },
    changeMapPosition(x,y){
      console.log('onscroll la map');

          let box = document.querySelector('#ixellesMap img');
          let boxInside = document.querySelector('#ixellesMap');
          let boxwidth = box.offsetWidth;
          let boxheight = box.offsetHeight;
          let decX = boxInside.offsetWidth/2;
          let decY = boxInside.offsetHeight/2;
          let posX = boxwidth*x/100 - decX;
          let posY = boxheight*y/100 - decY;
         document.getElementById('ixellesMap').scrollTo(posX, posY);
      
      
   
    }
   
  },
  data() {
    return {
      count: 0,
      locations: {},
      activelocation: {},
      view: 'list',
      blablaOpen: false,
      isWelcome:  true,
      tags: {},
      isv2: false
    }
  }
}
</script>