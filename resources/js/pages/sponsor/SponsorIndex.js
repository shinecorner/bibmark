import SideBar from './SideBar';
import _ from 'lodash';    

export default {
    components: { SideBar },
    props: ['sponsor', 'instagramPosts', 'twitterPosts'],
    data: function() {
        return {
        };
    },
    filters: {
        twitterDateFormat: function (value) {
          if (!value) return '';

          return value.substring(0, 20);
        },
        instagramDateFormat: function (value) {
            return new Date(value * 1000).toISOString().slice(0, 19).replace('T', ' ');
        }
    },
}
