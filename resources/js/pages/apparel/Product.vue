<template>
    <div class="container-fluid" style="background: #ffffff">
        <div class=" row col-lg">
            <div class="col-lg-4 col-12">
                <div class="pt-10 mt-10">
                    <h6 class="brand">Bibmark</h6>
                    <h2 class="tank">Invisible Tank</h2>
                    <ul>
                        <li>Athletic Fit: Run like you've got nothing on</li>
                        <li>Insanely soft fabric delivers superior breathability & incredible confort</li>
                        <li>4-way stretch construction moves better in every direction</li>
                        <li>Material wicks sweat & dries really fast</li>
                        <li>Anti-odor technology prevents the growth of odor-causing microbes</li>
                        <li>You won't feel any of the ink printed on this shirt. We pretty much tattoo it.</li>
                        <li>100% Microfiber</li>
                    </ul>
                    <div class="send">
                        <a class="join-cta-element d-flex" @click="saveDesign" href="#">
                            <img src="/img/auth/next.png" style="width: 64px; height: 64px;"/>
                            <div class="join-cta-labels d-flex flex-column ml-4">
                                <div class="join-cta-label-desc">Let’s get </div>
                                <div class="join-cta-label">Design Now</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-12">
                <div class="pt-10">
                    <img src="/img/products/img_product.png" width="100%" class="img-fluid"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'product',
    data() {
        return {
            user_id: Laravel.user.id,
        }
    },
    methods: {
        saveDesign() {
            const data = {
                user_id: this.user_id,
                name: 'Invisible Tank',
                exported_file: 'Some Design Name',
                image: '/img/design/front.png'
            }
            console.log(data)
            axios.post('/profile/my-design', data).then(response => {
                console.log(response.data);
                window.location.replace("/design")
            }).catch(error => {
                console.log(error)
            });
        }
    },
}
</script>
<style lang="scss" scoped>
@import '~@/_variables.scss';
@font-face {
        font-family: "SFProDisplay";
        src: url("/fonts/SF-Pro-Display-Regular.otf") format('truetype');
    }
    .container-fluid{
        padding: 0 4.9vw;
    }
@media(max-width:992px){
    .wrapper{
        width:100%;
        } 
}

.brand{
    opacity: 0.7;
    font-family: $font-family-sf-pro-display;
    font-size: 16px;
    font-weight: 500;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
    margin-bottom: 5px;
}
.tank{
    font-family: $font-family-sf-pro-display;
    font-size: 36px;
    font-weight: 500;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
}

.join-cta-label{
    font-family: $font-family-sf-pro-display;
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
    font-family: $font-family-sf-pro-display;
    font-size: 16px;
    font-weight: 500;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
}
.send{
    padding-top:45px;
}
.mt-10{
    margin-top:150px;
}
ul {
  margin-right: 0;
  margin-top: 35px;
  padding-left: 20px;
  font-family: $font-family-sf-pro-display;
  font-size: 20px;
}
li:not(:last-child) {
    margin-bottom: 5px;
}
.col-lg, .col-lg-4{
    margin: 0;
    padding: 0;
}
.col-lg-8{
    padding-right: 0;
}
</style>


