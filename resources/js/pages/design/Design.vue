<template>
    <div class="container-fluid" style="background: #ffffff">
        <div class=" row col-lg">
            <div class="col-lg-3 col-12">
                <div class="pt-10">
                    <h6 class="brand">Bibmark</h6>
                    <h2 class="tank">Invisible Tank</h2>
                    <h6 class="switch">
                        <img class="img-fluid" src="/img/design/switch.png"/>
                        Switch Product</h6>
                    <br>
                    <h4 class="size">Size</h4>
                    <div class="small-area">
                        <h4 class="small">Small <img class="img-fluid" style="padding-left:50px;" src="/img/design/arrow.png"/></h4>
                    </div>
                    <div>
                        <h4 class="sizing">
                            <img class="img-fluid" src="/img/design/ruler.png"/>
                            Sizing Chart
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <!-- <img class="img-fluid t-shirt" src="/img/design/t-shirt.png" style="max-width:90%"/> -->
                <!-- <div class="img-inline">
                    <img class="img-fluid" src="/img/design/zoom.png"/>
                    <img class="img-fluid" src="/img/design/plus.png"/>
                </div> -->
                <div class="bloc" style="height:300px; margin-left:30px;border:1px solid">
                    <h3 class="text-center" style="padding-top: 100px">{{ logs }}</h3>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <div class="pt-10">
                    <h4 class="title-right">Let’s Design</h4>
                    <hr class="bar"/>
                    <div class="wrapper center-block">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading active" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            Base
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse show collapse in" role="tabpanel"
                                    aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-template" role="tab" aria-controls="nav-template" aria-selected="true">Template</a>
                                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-colors" role="tab" aria-controls="nav-colors" aria-selected="false">Colors</a>
                                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-textures" role="tab" aria-controls="nav-textures" aria-selected="false">Textures</a>
                                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-design" role="tab" aria-controls="nav-design" aria-selected="false">My Designs</a>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show custom-scrollbar active" id="nav-template" role="tabpanel" aria-labelledby="nav-home-tab">
                                                <div class="custom-scrollbar__inner" style="height:200px; overflow-y: scroll;">
                                                <div class="img-inline">
                                                    <a href="" @click.prevent="addTemplate('Front')"><img class="img-fluid img-template" src="/img/design/front.png"/></a>
                                                    <a href="" @click.prevent="addTemplate('Back')"><img class="img-fluid img-template" src="/img/design/back.png"/></a>
                                                    <a href="" @click.prevent="addTemplate('Left')"><img class="img-fluid img-template" src="/img/design/left.png"/></a>
                                                    <!-- <img class="img-fluid img-template" src="/img/design/right.png"/> -->
                                                </div>
                                                <div class="img-inline">
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                </div>
                                                <div class="img-inline">
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                </div>
                                                <div class="img-inline">
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                </div>
                                                <div class="img-inline">
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                </div>
                                                <div class="img-inline">
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                    <img class="img-fluid img-template" src="/img/design/small.png"/>
                                                </div>
                                                <div class="custom-scrollbar__bar">
                                                    <div class="custom-scrollbar__knob"></div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="tab-pane fade" id="nav-colors" role="tabpanel" aria-labelledby="nav-profile-tab">Colors</div>
                                            <div class="tab-pane fade" id="nav-textures" role="tabpanel" aria-labelledby="nav-contact-tab">Textures</div>
                                            <div class="tab-pane fade" id="nav-design" role="tabpanel" aria-labelledby="nav-contact-tab">My design</div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="bar"/>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                            href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Art
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-featured" role="tab" aria-controls="nav-featured" aria-selected="true">Featured</a>
                                                <a class="nav-item nav-link" id="nav-clipart-tab" data-toggle="tab" href="#nav-clipart" role="tab" aria-controls="nav-clipart" aria-selected="false">Clipart</a>
                                                <a class="nav-item nav-link" id="nav-upload-tab" data-toggle="tab" href="#nav-upload" role="tab" aria-controls="nav-upload" aria-selected="false">Upload</a>
                                                <a class="nav-item nav-link" id="nav-art-tab" data-toggle="tab" href="#nav-art" role="tab" aria-controls="nav-art" aria-selected="false">My Art</a>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-featured" role="tabpanel" aria-labelledby="nav-home-tab">
                                                Featured
                                            </div>
                                            <div class="tab-pane fade" id="nav-clipart" role="tabpanel" aria-labelledby="nav-profile-tab">Clipart</div>
                                            <div class="tab-pane fade" id="nav-textures" role="tabpanel" aria-labelledby="nav-contact-tab">Upload</div>
                                            <div class="tab-pane fade" id="nav-design" role="tabpanel" aria-labelledby="nav-contact-tab">My Art</div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="bar"/>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                            href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Text
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                    </div>
                                </div>
                                <hr class="bar"/>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingFour">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                            href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Save & Share
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingFour">
                                    <div class="panel-body">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="nav-sponsors-tab" data-toggle="tab" href="#nav-sponsors" role="tab" aria-controls="nav-sponsors" aria-selected="true">Sponsors</a>
                                                <a class="nav-item nav-link" id="nav-charities-tab" data-toggle="tab" href="#nav-charities" role="tab" aria-controls="nav-charities" aria-selected="false">Charities</a>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-sponsors" role="tabpanel" aria-labelledby="nav-home-tab">
                                                <!-- <div class="d-flex justify-content-around">
                                                    <span class="w-25 text-center" v-for="(sponsor, key) in sponsors" :key="key">
                                                        <a href="#"><img :src="sponsor.logo" class="img-fluid" alt=""></a>
                                                        <span class="text-center"><a href="#">{{ sponsor.name }}</a></span>
                                                    </span>
                                                </div> -->
                                                <div class="avatars">
                                                    <template v-if="sponsors.length>0">
                                                        <div class="avatar w-25" v-for="(sponsor, key) in sponsors" :key="key">
                                                            <img :src="sponsor.filename" alt="" class="img-fluid ui-w-100">
                                                            <div class="name">{{ sponsor.name }}</div>
                                                        </div>
                                                    </template>
                                                    <template v-else>
                                                    <div class="">No data available</div>
                                                    </template>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="nav-charities" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                <!-- <div class="d-flex justify-content-around">
                                                    <span class="w-25" v-for="(charity, key) in charities" :key="key">
                                                        <a href="#"><img :src="charity.logo" class="img-fluid" alt=""></a>
                                                        <span class="text-center"><a href="#">{{ charity.name }}</a></span>
                                                    </span>
                                                </div> -->
                                                <div class="avatars">
                                                    <template v-if="charities.length>0">
                                                    <div class="avatar w-25" v-for="(charity, key) in charities" :key="key">
                                                        <img :src="charity.filename" alt="" class="img-fluid ui-w-100">
                                                        <div class="name">{{ charity.name }}</div>
                                                    </div>
                                                    </template>
                                                    <template v-else>
                                                        <div class="">No data available</div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="bar"/>
                            </div>
                            <div class="send">
                                <a class="join-cta-element d-flex justify-content-md-end" href="#">
                                    <img src="/img/auth/next.png" style="width: 64px; height: 64px;"/>
                                    <div class="join-cta-labels d-flex flex-column ml-4">
                                        <div class="join-cta-label-desc">Let’s get </div>
                                        <div class="join-cta-label">Sponsored</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            charities: {},
            sponsors:{},
            logs: ''
        }
    },
    mounted(){
        this.getCharities();
        this.getSponsors();

        var knob = document.querySelector('.custom-scrollbar__knob');
        var bar = document.querySelector('.custom-scrollbar__bar');
        var container = document.querySelector('.custom-scrollbar__inner');

        // When the container is scrolled
        container.addEventListener('scroll', () => {
        // If we are dragging the knob, do nothing
        if (dragging) return;

        // Otherwise, set the knob position based on the scroll position
        knob.style.top = container.scrollTop / (container.scrollHeight - container.offsetHeight) * 100 + '%';
        });

        var dragging = false;
        knob.addEventListener('mousedown', event => {
        dragging = {
            x: event.clientX,
            y: event.clientY };

        });
        window.addEventListener('mousemove', event => {
        if (dragging) {
            // When dragging
            event.preventDefault();
            var diff = {
            x: event.clientX - dragging.x,
            y: event.clientY - dragging.y

            // Clamp the position of the knob to be a maximum of 
            // the knobs container, and a minimum of 0
            };var newTop = Math.max(0, Math.min(knob.offsetTop + diff.y, bar.offsetHeight));
            knob.style.top = newTop + 'px';

            // Base the scroll offset on the knobs position
            // in relation to the knobs container
            var scrollOffset = newTop / bar.offsetHeight * (container.scrollHeight - container.offsetHeight);
            container.scrollTop = scrollOffset;

            dragging = {
            x: event.clientX,
            y: event.clientY };

        }
        });
        window.addEventListener('mouseup', () => {
        dragging = false;
        });
    },
    methods: {
        addTemplate(name){
            // var obj = `{
            //     "name" : "Front",
            //     "template" : "Test template"
            // }`;
            var json = `{
                "template":{
                "name":"Test Template"
                }
            }`
            
            this.logs = name + ' Template Added'
        },
        getCharities() {
            axios.get('/charities').then(response => {
                if (response.data) {
                    this.charities = response.data;
                }
            }).catch(error => {
                console.log('Error', error);
            });
        },
        getSponsors(){
            axios.get('/sponsors').then(response => {
                console.log(response.data)
                if (response.data) {
                    this.sponsors = response.data;
                }
            }).catch(error => {
                console.log('Error', error);
            });
        }
    },
}
</script>
<style scoped>
@font-face {
        font-family: "SFProDisplay";
        src: url("/fonts/SF-Pro-Display-Regular.otf") format('truetype');
    }
    .container-fluid{
        padding: 0 4vw;
    }
    @media(max-width:992px){
.wrapper{
    width:100%;
} 
}
.panel-heading {
    padding: 0;
	border:0;
}
.panel-title>a, .panel-title>a:active{
	display:block;
	/* padding:15px; */
	text-decoration:none;
    font-family: HelveticaNeue;
    font-size: 18px;
    font-weight: bold;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #444444;
}
.panel-heading  a:before {
    font-family: 'Glyphicons Halflings';
    content: url(/img/Design/arrow.png);
    float: right;
    transition: all 0.5s;
}
.panel-heading.active a:before {
	/* -webkit-transform: rotate(180deg);
	-moz-transform: rotate(180deg);
	transform: rotate(180deg); */
}

/* Tabs css*/
.nav-tabs{
    border-bottom: 0;
}
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    /* background: moccasin; */
    border-bottom: solid 3px #ffc600;
    font-weight: 600;
    width: -webkit-fit-content;
    width: -moz-fit-content;
    width: fit-content;
    /* padding-left: 0 !important;
    padding-right: 0 !important; */
    padding-bottom: 5px;
}
.nav-tabs .nav-link {
    border: 0px solid transparent;
    padding-left:0px;
    padding-right: 0px;
    margin-right:10px !important;
}
.nav-link{
    padding-left: 0;
    padding-right: 0.85rem;
    padding-bottom: 0.3rem;
    font-family: sf-pro-display;
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #777777;
}

.title-right{
    font-family: sf-pro-display;
    font-size: 34px;
    font-weight: 600;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #444444;
}
.bar{
    border-bottom: solid 1.8px #cccccc;
    margin-top: 0.5rem !important;
    margin-bottom: 1.1rem !important;
}
.tab-content{
    padding-top: 15px;
    padding-bottom: 10px;
}
#nav-tabContent .img-inline{
    display: flex;
    justify-content:space-between;
    padding-top: 20px;
}
.brand{
    opacity: 0.7;
    font-family: sf-pro-display;
    font-size: 16px;
    font-weight: 500;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
}
.tank{
    font-family: sf-pro-display;
    font-size: 36px;
    font-weight: 500;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
}
.switch{
    opacity: 0.7;
    font-family: sf-pro-display;
    font-size: 16px;
    font-weight: 500;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #7c7c7c;
}
.size{
    font-family: sf-pro-display;
    font-size: 30px;
    font-weight: 500;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
}
.sizing{
    opacity: 0.7;
    font-family: sf-pro-display;
    font-size: 16px;
    font-weight: 500;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #7c7c7c;
}
.small{
    font-family: sf-pro-display;
    font-size: 18px;
    font-weight: 500;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.33;
    letter-spacing: normal;
    color: #444444;
}
.join-cta-label{
    font-family: sf-pro-display;
    font-size: 24px;
    font-weight: 500;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
}
.join-cta-label-desc{
    opacity: 0.6;
    font-family: sf-pro-display;
    font-size: 16px;
    font-weight: 500;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
}
.send{
    padding-top:25px;
}
.pt-10{
    padding-top:20px;
}
.t-shirt{
    /* float:right; */
    padding-left: 60px;
}


/* Custom scroll bar */
.custom-scrollbar {
    position: relative;
    /* width: 400px; */
    height: 200px;
    overflow: hidden;
}

.custom-scrollbar__inner {
    height: 200px;
    width: calc(100% + 40px);
    padding-right: 64px;
    overflow-y: scroll;
    -webkit-overflow-scrolling: touch;
}


.custom-scrollbar__bar {
    position: absolute;
    top: 16px;
    bottom: 16px;
    background: #cccccc;
    width: 6px;
    right: 8px;
    border-radius: 2px;
}

.custom-scrollbar__knob {
    position: absolute;
    top: 0;
    left: 50%;
    width: 20px;
    height: 20px;
    border-radius: 18px;
    border: solid 4px #757575;
    background-color: #ffffff;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    will-change: top;
} 
.img-template{
    /* width: 80%; */
    /* padding-right:10px; */
}
@media (min-width: 768px) and (max-width: 1024px) {
    /* .img-template{
        width: 50%;
        padding-right:10px;
    } */
}


.avatars{
        display: flex;
        /* justify-content: space-around; */
        align-content: flex-start;
        flex-wrap: wrap;
    }
    .avatar{
        cursor: pointer;
    }
    .avatars{
        /* padding-left: 3%; */
    }

    .avatar{
        padding: 10px;
    }
    .avatars img:hover { 
        border: 1px solid #26B4FF;
    }
    .name{
        text-align: center;
    }
</style>


