<template>
    <div class="flex flex-col justify-center" @click="playVideo">
      <div class="text-center text-zinc-800 text-[29px] font-semibold">{{data.title}}</div>
      <div class="text-center text-gray-600 text-base leading-relaxed mb-6">{{data.caption}}</div>
      <div class="mx-auto relative">
        <video class="w-full" controls :poster="data.poster_image" ref="videoref">
          <source :src="data.video" type="video/mp4">
        </video>
        <div v-if="showplaybutton" class="absolute start-1/2 inset-y-1/2 translate-x-[-50%] translate-y-[-50%]">
          <span>
            <img src="/images/pagebuilder/videoplayer/youtube2.png"/>
          </span>
        </div>
      </div>
    </div>
</template>
  <script>
  export default {
    props: {
      data: {
        type: Object,
        required: true
      },
    },
    data() {
      return {
        showplaybutton: true
      };
    },
    methods: {
      playVideo() {
        const video = this.$refs.videoref;
        if (video) {
          video.play();
          this.showplaybutton = false;
        }
      }
    },
  };
  </script>
