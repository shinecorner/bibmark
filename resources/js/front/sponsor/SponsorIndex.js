import SideBar from './SideBar';

export default {
    components: { SideBar },
    props: ['sponsor'],
    data () {
        return {
          loadingTweets: false,
          loadingInstagrams: false,
          uploadingProfilePicture: false,
          tweets: [],
          instagramPosts: [],
          logoFile: '',
          origLogoURL: ''
        }
    },
    mounted () {
        this.origLogoURL = (this.sponsor.logo) ? this.sponsor.logo : '';
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
                    this.loadingInstagrams = true;
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
                .finally(() => this.loadingInstagrams = false)
        },
        editProfile: function(){
          window.location = `/sponsor/${this.sponsor.id}/profile/edit`;
        },
        selectProfilePicture: function(event){    
          this.uploadingProfilePicture = true;  
          this.logoFile = this.$refs.logo.files[0];
          let formData = new FormData();
          formData.append('logo', this.logoFile);
          formData.append('id', this.sponsor.id);
          axios.post( `/sponsor/${this.sponsor.id}/profile/updateProfilePicture`,
            formData,
            {
              headers: {
                  'Content-Type': 'multipart/form-data'
              }
            }
          ).then(response => {             
            this.origLogoURL = response.data.sponsor.logo;            
          })
          .catch(error => {
            console.log(error);
          }).finally(() => this.uploadingProfilePicture = false);
        },
    },
    filters: {
        twitterDateFormat: function (value) {
          if (!value) return '';

          return value.substring(4, 10);
        },
    },
}
