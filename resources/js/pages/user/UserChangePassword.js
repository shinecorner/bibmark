export default {
    props: {
        userId: {
            type: [Number, String],
            required: true
        },        
    },
    data: function() {
        return {
            password: '',
            confirm_password: ''
        };
    },
    // mounted: function() {
    //     this.initValidation();
    // },
    watch: {
        
    },
    methods: {      
        save: function(e) {
            e.preventDefault();            
                        
            $('#input-form').block({
                message: '<div class="sk-wave sk-primary"><div class="sk-rect sk-rect1"></div> <div class="sk-rect sk-rect2"></div> <div class="sk-rect sk-rect3"></div> <div class="sk-rect sk-rect4"></div> <div class="sk-rect sk-rect5"></div></div>',
                css: {
                  backgroundColor: 'transparent',
                  border: '0'
                },
                overlayCSS:  {
                  backgroundColor: '#fff',
                  opacity: 0.8
                }
            });
            var ladda = Ladda.create(document.querySelector('.ladda-button'));
            ladda.start();

            if (this.userId) {
                this.$validator.validateAll().then((result) => {
                    if (result) {                        
                        axios.post(
                            '/dashboard/user/'+ this.userId +'/change-password', 
                            {
                                password: this.password
                            }
                        ).then((response) => {
                            $('#input-form').unblock();
                            ladda.stop();
                            if(response.data.success){
                                window.history.go(-1);
                            }                            
                        }).catch((error) => {
                            $('#input-form').unblock();
                            ladda.stop();
                        });
                        return;
                    }
                    if(!result){
                        $('#input-form').unblock();
                        ladda.stop();
                    }
                  });              
            } 

        }
    }
}