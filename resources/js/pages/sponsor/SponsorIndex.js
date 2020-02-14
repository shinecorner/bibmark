import SideBar from './SideBar';

export default {
    components: { SideBar },
    props: ['sponsor'],
    data () {
        return {
          loadingTweets: false,
          loadingInstagramPosts: false,
          tweets: [],
          instagramPosts: []
        }
    },
    mounted () {
        this.loadTweets();
    },
    methods: {
        loadTweets: function (event) {
            this.loadingTweets = true;
            axios
                .get(`/api/sponsors/${this.sponsor.id}/posts/twitter`)
                .then(response => {
                    this.tweets = response.data;
                })
                .catch(error => {
                  console.log(error)
                })
                .finally(() => {
                    this.loadingTweets = false;
                    this.loadingInstagramPosts = true;
                    this.loadInstagramImages();
                })
        },
        loadInstagramImages: function (event) {
            axios
                .get(`/api/sponsors/${this.sponsor.id}/posts/instagram`)
                .then(response => {
                    this.instagramPosts = response.data;
                })
                .catch(error => {
                  console.log(error)
                })
                .finally(() => this.loadingInstagramPosts = false)
        },
    },
    filters: {
        twitterDateFormat: function (value) {
          if (!value) return '';

          return value.substring(0, 10);
        },
    },
}
