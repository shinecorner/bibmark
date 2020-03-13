export default {
    name: "Dasboard",
    props: {
        isAdmin: {
            type: Number
        },
        userId: {
            type: Number
        }
    },
    data: function () {
        return {
            userSponsors: {},
            userCharities: {},
            userEvents: {},
            totalSponsors: {},
            totalCharities: {},
            totalEvents: {},
            totalUsers: {},
        };
    },
    mounted() {
        this.getUserProps(this.userId);
    },
    methods: {
        getUserProps(id) {
            axios.get('/internal/user/'+id+'/dashboard_achievements')
                .then(response => {
                    if (!this.isAdmin) {
                        this.userSponsors = JSON.parse(response.data.user_sponsors);
                        this.userCharities = JSON.parse(response.data.user_charities);
                        this.userEvents = JSON.parse(response.data.user_events);

                        if (this.userSponsors.length === 1  && this.userCharities.length === 0 && this.userEvents.length === 0) {
                            window.location.replace('/dashboard/sponsor/' + this.userSponsors[0].id + '/home');
                        } else if (this.userSponsors.length === 0 && this.userCharities.length === 1 && this.userEvents.length === 0) {
                            window.location='/dashboard/charity/'+ this.userSponsors[0].id +'/home';
                        } else if (this.userSponsors.length === 0 && this.userCharities.length === 0 && this.userEvents.length === 1) {
                            window.location='/dashboard/event/'+ this.userEvents[0].id +'/home';
                        }

                    } else {
                        this.totalSponsors = JSON.parse(response.data.total_sponsors);
                        this.totalCharities = JSON.parse(response.data.total_charities);
                        this.totalEvents = JSON.parse(response.data.total_events);
                        this.totalUsers = JSON.parse(response.data.total_users);
                    }

                })
                .catch(errors => {
                     //console.log(errors.response);
                });

        }
    }
}