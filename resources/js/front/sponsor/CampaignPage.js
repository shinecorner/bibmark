export default {

    data() {
        return {
            navLink: 'Campaigns',
            finalCampaigns: []
        };
    },
    props: {
        campaigns: {
            type: Array,
            require: true
        },
        sponsor: {
            type: Object,
            require: true
        }
    },
    created() {
       this.finalCampaigns = this.campaigns;
    },

    methods: {
        getCampaigns: function() {
            axios.get('/sponsor/' + this.sponsor.id + '/campaign/list-json')
            .then((response) => {
                this.finalCampaigns = response.data.campaigns;
                $('#campaign-list').unblock();
            });
        },
        addCampaign() {
            window.location.href = `/sponsor/${this.sponsor.id}/campaign/create`;
        },
        editCampaign: function(campaignId) {
            window.location.href = `/sponsor/${this.sponsor.id}/campaign/${campaignId}/edit`;
        },
        removeCampaign: function(campaignId) {
            var self = this;
            bootbox.confirm({
                message: 'Are you sure remove this campaign?',
                className: 'bootbox-sm',
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'bg-yellow'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn'
                    }
                },
                callback: function(result) {
                    if (result) {
                        $('#campaign-list').block({
                            message: '<div class="sk-wave sk-yellow"><div class="sk-rect-fix sk-rect1"></div> <div class="sk-rect-fix sk-rect2"></div> <div class="sk-rect-fix sk-rect3"></div> <div class="sk-rect-fix sk-rect4"></div> <div class="sk-rect-fix sk-rect5"></div></div>',
                            css: {
                                backgroundColor: 'transparent',
                                border: '0'
                            },
                            overlayCSS: {
                                backgroundColor: '#fff',
                                opacity: 0.8
                            }
                        });
                        axios.delete('/campaign/' + campaignId)
                        .then((response) => {
                            self.getCampaigns(function() {
                                $('#campaign-list').unblock();
                            });
                        })
                        .catch((error) => {
                            $('#campaign-list').unblock();
                        });
                    }
                },
            });
        }
    },
    beforeMounted: function(){
        this.getCampaigns();
    }
}
