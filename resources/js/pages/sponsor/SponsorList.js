export default {
    props:[],
    data: function() {
        return {
            sponsorId: 0,
        };
    },
    mounted: function () {
        this.getSponsors();

        var self = this;
        $('#sponsor-list').on('click', '.btn-remove', function() {
            self.sponsorId = $(this).attr('data');
            self.removeSponsor();
        });
    },
    watch: {

    },
    methods: {
        getSponsors: function(callback) {
            $('#sponsor-list').dataTable({
                "destroy": true,
                "ajax": {
                    url: '/internal/sponsors',
                    dataSrc: function(json) {
                        let data = [];
                        json.sponsors.forEach(sponsor => {
                            data.push([
                                sponsor.id,
                                sponsor.name,
                                sponsor.logo,
                                sponsor.background_image,
                                sponsor.balance,
                                sponsor.budget,
                                sponsor.created_at ? moment(sponsor.created_at.date).format('YYYY-MM-DD') : null,
                                '',
                            ]);
                        });
                        if (callback) {
                            callback();
                        }

                        return data;
                    }
                },
                "columnDefs": [{
                    targets: [2, 3, 7],
                    orderable: false,
                    searchable: false
                }],
                "createdRow": function(row, data, index) {
                    var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';
                    $('td', row).eq(1).html('').append(
                        '<a href="sponsors/' + data[0] + '">' + data[1] + '</a>'
                    );
                    if (data[2]) {
                        $('td', row).eq(2).html('').append(
                            '<img style="width: 80px; height: 80px; object-fit: contain;" src="' + data[2] + '" />'
                        );
                    }
                    if (data[3]) {
                        $('td', row).eq(3).html('').append(
                            '<img style="width: 80px; height: 80px; object-fit: contain;" src="' + data[3] + '" />'
                        );
                    }
                    $('td', row).eq(7).addClass('text-center text-nowrap').html('').append(
                    '<button type="button" class="btn btn-default btn-xs icon-btn md-btn-flat user-tooltip" title="Edit" onclick="window.location=\'/sponsor/' + data[0] + '/profile/edit\'"><i class="ion ion-md-create"></i></button>&nbsp;&nbsp;' +
                    // '<button type="button" class="btn btn-default btn-xs icon-btn md-btn-flat user-tooltip" title="Edit" onclick="window.location=\'sponsors/' + data[0] + '/edit\'"><i class="ion ion-md-create"></i></button>&nbsp;&nbsp;' +
                    '<div class="btn-group">' +
                        '<button type="button" class="btn btn-default btn-xs icon-btn md-btn-flat dropdown-toggle hide-arrow user-tooltip" title="Actions" data-toggle="dropdown"><i class="ion ion-ios-settings"></i></button>' +
                        '<div class="dropdown-menu' + (isRtl ? '' : ' dropdown-menu-right') + '">' +
                        // '<a class="dropdown-item" href="sponsors/' + data[0] + '">View sponsor</a>' +
                        '<a class="dropdown-item" href="/sponsor/' + data[0] + '/campaign">View campaigns</a>' +
                        '<a class="dropdown-item btn-remove" href="javascript:void(0)" data="' + data[0] + '">Remove</a>' +
                        '</div>' +
                    '</div>'
                    );
                }
            });
        },
        removeSponsor: function() {
            var self = this;
            bootbox.confirm({
                message: 'Are you sure remove this sponsor?',
                className: 'bootbox-sm',
                callback: function(result) {
                    if (result) {
                        $('#sponsor-list').block({
                            message: '<div class="sk-wave sk-primary"><div class="sk-rect sk-rect1"></div> <div class="sk-rect sk-rect2"></div> <div class="sk-rect sk-rect3"></div> <div class="sk-rect sk-rect4"></div> <div class="sk-rect sk-rect5"></div></div>',
                            css: {
                                backgroundColor: 'transparent',
                                border: '0'
                            },
                            overlayCSS: {
                                backgroundColor: '#fff',
                                opacity: 0.8
                            }
                        });
                        axios.delete('/internal/sponsors/' + self.sponsorId)
                        .then((response) => {
                            self.getSponsors(function() {
                                $('#sponsor-list').unblock();
                            });
                        })
                        .catch((error) => {
                            $('#sponsor-list').unblock();
                        });
                    }
                },
            });
        }
    }
}
