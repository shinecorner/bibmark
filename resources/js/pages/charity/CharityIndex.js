import SideBar from './SideBar';

export default {
    components: { SideBar },
    props: ['charity'],
    data () {
        return {
          loadingTweets: false,
          loadingInstagrams: false,
          tweets: [],
          instagramPosts: []
        }
    },
    mounted () {
        this.loadTweets();
        this.loadInstagramImages();
    },
    methods: {
        loadTweets: function (event) {
            this.loadingTweets = true;
            axios
                .get(`/api/charities/${this.charity.id}/posts/twitter`)
                .then(response => {
                    this.tweets = response.data;
                })
                .catch(error => {
                  console.log(error)
                })
                .finally(() => {this.loadingTweets = false})
        },
        loadInstagramImages: function (event) {
            this.loadingInstagrams = true;
            axios
                .get(`/api/charities/${this.charity.id}/posts/instagram`)
                .then(response => {
                    this.instagramPosts = response.data;
                })
                .catch(error => {
                  console.log(error)
                })
                .finally(() => this.loadingInstagrams = false)
        },
    },
    filters: {
        twitterDateFormat: function (value) {
          if (!value) return '';

          return value.substring(4, 10);
        },
    },
}
