const STATUS_ADDED = 0;
const STATUS_LOADING = 0;
const STATUS_LOADED = 0;
const STATUS_RENDERED = 0;
const STATUS_UPDATED = 0;

export default {
    props:['design_id'],
    data: function () {
        return {
            components: [
                {
                    name: 'LEFT SLEEVE',
                    key: 'left_sleeve'
                },
                {
                    name: 'FRONT PANEL',
                    key: 'front'
                },
                {
                    name: 'BACK PANEL',
                    key: 'back'
                },
                {
                    name: 'RIGHT SLEEVE',
                    key: 'right_sleeve'
                }
            ],
            art: {
                featured: [
                    {
                        path: '/img/art/running.png',
                        type: 'image',
                        width: 100,
                        height: 100,
                        ratio: 1,
                        min: {
                          width: 20
                        },
                        max: {
                            width: 512
                        },
                        angle: 0,
                        color: ''
                    },
                    {
                        path: '/img/art/starbucks.png',
                        type: 'image',
                        width: 100,
                        height: 100,
                        ratio: 1,
                        min: {
                            width: 20
                        },
                        max: {
                            width: 1011
                        },
                        angle: 0,
                        color: ''
                    }
                ]
            },
            isMouseDown: false,
            mouseInitial: {},
            selectedLayerIndex: -1,
            rotation: 0,
            cover_image: null,
            front_color: '',
            back_color: '',
            left_sleeve_color: '',
            right_sleeve_color: '',
            collar_color: '',
            firstRenderComplete: false,
            layers: [],
            design: {},
            templates: null,
            models: null,
            screen: {
                width: 0,
                height: 0
            },
            tile: 1,
            offset: {
                h: 0,
                v: 0
            },
            angle: 0,
            movement: {
                x: 0,
                y: 0,
                z: 0
            },
            animation: {
                rotation: {
                    x: 0,
                    y:0,
                    z:0
                },
                movement: {
                    x:0,
                    y:0,
                    z:0
                },
                offset:{
                    h:0,
                    v:0
                }
            },
            animate: false,
            camera_config: {
                "camera_position":{
                    x: 0,
                    y: 100,
                    z: 280
                },
                "camera_fov":45,
                "camera_aspect":1,
                "camera_near":1,
                "camera_far":4000
            },
            scenes: {},
            objects: {},
            textures: {},
            selectedTexture: 0,
            currentScene: "",
            interval: 0,
            hiddenCanvas: null,
            isLoading: false,
            cameraAspect: 1,
            camera: null,
            renderer: null,
            manager: null,
            texShader: null
        };
    },
    mounted: function () {
        this.loadEngine();
        this.getModels(()=>{
            this.getTemplates(()=>{
                this.getDesign(()=>{
                    this.parseDesign();
                })
            });
        });

    },
    watch: {
        layers:{
            deep: true,
            handler: function(v){
                this.render();
            }
        },
        rotation: function(v) {
            this.objects[this.currentScene].object.rotation.y = v;
        },
        front_color: function (v) {
            if(this.firstRenderComplete) {
                this.customizeTemplateColor('front_color',v.hex);
            }

        },
        back_color: function (v) {
            if(this.firstRenderComplete)
                this.customizeTemplateColor('back_color',v.hex);
        },
        left_sleeve_color: function (v) {
            if(this.firstRenderComplete)
                this.customizeTemplateColor('left_sleeve_color',v.hex);
        },
        right_sleeve_color: function (v) {
            if(this.firstRenderComplete)
                this.customizeTemplateColor('right_sleeve_color',v.hex);
        }
    },
    methods: {
        updateLayerScale: function(e){
            this.layers[this.selectedLayerIndex].width = parseInt(e.target.value);
            this.layers[this.selectedLayerIndex].height = parseInt(e.target.value) * this.layers[this.selectedLayerIndex].ratio;
        },
        parseDesign: function(){
            if(!this.templates[this.design.data.template.id]) {
                return;
            }
            let template = this.templates[this.design.data.template.id];
            this.addTexture(this.design.data.template.id,{
                aspect: template.ratio,
                path: template.image,
                thumbnail: template.thumbnail
            });
            if(this.design.data.template.layers) {
                this.design.data.template.layers.forEach((layer)=>{
                    if(layer.enabled) {
                        if (layer.type === 'image') {
                            var img = new Image();
                            img.src = layer.path;
                            img.crossOrigin = "Anonymous";
                            layer.image = img;
                            this[layer.name] = layer.path;
                        } else if (layer.type === 'fill') {
                            this[layer.name] = {
                                hex: layer.color
                            }
                        }
                    }
                })
            }
            this.loadTexture(this.design.data.template.id,()=>{
                this.addScene('blank');
                this.addScene(this.design.product_code);
                this.currentScene = this.design.product_code;
                this.loadObject(this.design.product_code,this.models[this.design.product_code].object,'_lod',this.models[this.design.product_code].properties,()=>{
                    let viewOptions = [];
                    this.applyTexture(this.design.data.template.id,this.currentScene,()=>{
                        //_loader.update(60);
                        setTimeout(()=>{
                            //_loader.hide();
                            this.render(this.currentScene);

                        },500);
                    });
                });
            })
        },
        getDesign: function(cb){
            if(parseInt(this.design_id) === 0) {
                this.design = {
                    id: null,
                    name: 'New Design',
                    product_name: '',
                    product_code: 'shirt',
                    size: {
                        id: 1,
                        name: 'S'
                    },
                    data: {
                        template: {
                            id: 1,
                            layers: [
                                /*
                                {
                                    name: 'cover_image',
                                    type: 'image',
                                    path: 'https://s3.amazonaws.com/com.wrapview/textures/bibmark_texture.png'
                                },

                                 */

                                {
                                    name: 'left_sleeve_color',
                                    type: 'fill',
                                    color: '',
                                    x: 0,
                                    y: 0,
                                    width: 400,
                                    height: 400,
                                    enabled: false
                                },
                                {
                                    name: 'right_sleeve_color',
                                    type: 'fill',
                                    color: '',
                                    x: 1630,
                                    y: 0,
                                    width: 400,
                                    height: 400,
                                    enabled: false
                                },
                                {
                                    name: 'front_color',
                                    type: 'fill',
                                    color: '',
                                    x: 400,
                                    y: 60,
                                    width: 600,
                                    height: 900,
                                    enabled: false
                                },
                                {
                                    name: 'back_color',
                                    type: 'fill',
                                    color: '',
                                    x: 1000,
                                    y: 60,
                                    width: 600,
                                    height: 900,
                                    enabled: false
                                },
                                {
                                    name: 'collar_color',
                                    type: 'fill',
                                    color: '',
                                    x: 600,
                                    y: 0,
                                    width: 1000,
                                    height: 60,
                                    enabled: false
                                }
                            ]
                        },

                    }
                }
            }
            if(typeof cb === 'function'){
                cb();
            }
        },
        getTemplates: function(cb){
            this.templates = {
                1: {
                    texture_id: 1,
                    image: 'https://combibmark.s3.amazonaws.com/design/bibmark_blank_texture',
                    ratio: 2.66,
                    is_locked: false
                },
                2: {
                    texture_id: 2,
                    image: 'https://s3.amazonaws.com/com.wrapview/textures/bibmark_texture_orange',
                    ratio: 2.66
                }
            };
            if(typeof cb === 'function'){
                cb();
            }
        },
        getModels: function(cb){
            this.models = {
                shirt: {
                    name: 'shirt',
                    code: 'b7859564bb78cfca3c6464fbaf093091',
                    object: 'https://s3.amazonaws.com/com.wrapview/models/bibmark_shirt',
                    properties: {
                        position: {
                            y: -150,
                            z: 0,
                            x: 0
                        },
                        rotation: {
                            x: 0.1,
                            y: 0
                        },
                        scale: 2,
                        components: {
                            front: {
                                x: 400,
                                y: 60,
                                width: 600,
                                height: 900,
                                defaultEntry: {
                                    x: 600,
                                    y: 350
                                }
                            },
                            back: {
                                x: 1000,
                                y: 60,
                                width: 600,
                                height: 900
                            },
                            left_sleeve: {
                                x: 0,
                                y: 0,
                                width: 400,
                                height: 400,
                                defaultEntry: {
                                    x: 200,
                                    y: 200
                                }
                            },
                            right_sleeve: {
                                x: 1630,
                                y: 0,
                                width: 400,
                                height: 400
                            },
                            collar: {
                                x: 0,
                                y: 0,
                                width: 100,
                                height: 100
                            }

                        }
                    }
                }
            };
            if(typeof cb === 'function'){
                cb();
            }
        },
        loadEngine: function(){
            this.loadCamera();
            this.loadRenderer();
            this.loadManager();
            this.loadHiddenCanvas();
            this.loadViewport();
        },
        addScene: function(scene){
            var sObject = {};
            sObject['scene'] = new THREE.Scene();
            sObject['status'] = STATUS_ADDED;
            sObject['texture'] = 0;
            this.scenes[scene] = sObject;
            this.setSceneLighting(scene);
        },
        setSceneLighting: function(scene) {
            var r_disLight_02 = new THREE.DirectionalLight(0xffffff,0.6);
            r_disLight_02.position.set( -5,3,5 );
            this.scenes[scene].scene.add( r_disLight_02 );

            var l_disLight_02 = new THREE.DirectionalLight(0xFFFFFF,0.3);
            l_disLight_02.position.set( 5,0,3 );
            this.scenes[scene].scene.add( l_disLight_02 );

            var rim_disLight_02 = new THREE.DirectionalLight(0xFFFFFF,0.15);
            rim_disLight_02.position.set( 5,0,-4.5 );
            this.scenes[scene].scene.add( rim_disLight_02 );

            var ambLight_01 = new THREE.AmbientLight(0x666666);
            this.scenes[scene].scene.add( ambLight_01 );
        },
        loadObject : function(scene, path, ext, data, callback) {

            var loader = new THREE.OBJMTLLoader( this.manager );
            var oObject = {};
            oObject['status'] = STATUS_ADDED;
            oObject['object'] = {}


            loader.load( path+ext+'.obj', path+ext+'.mtl', ( object ) => {
                object.position.y = data.position.y;
                object.rotation.x = data.rotation.x;
                object.rotation.y = data.rotation.y;
                object.scale.x = data.scale;
                object.scale.y = data.scale;
                object.scale.z = data.scale;
                try {
                    this.scenes[scene].scene.remove(this.objects[scene].object);
                } catch(e){

                }
                this.objects[scene] = oObject;
                this.objects[scene].object = object;
                this.objects[scene].status = STATUS_LOADED;
                this.scenes[scene].scene.add(this.objects[scene].object);
                if(typeof callback == 'function'){
                    callback();
                    if(ext !== '') {
                        this.loadObject(scene, path, '', data, callback);
                    } else {
                        this.applyTexture(this.selectedTexture,this.currentScene,()=>{

                        });
                    }
                }
            });
        },
        addTexture: function(id, data) {
            if(typeof this.textures[id] != 'undefined'){
                return;
            }

            var tObject = {};
            tObject['texture'] = new THREE.Texture();

            tObject['status'] = STATUS_ADDED;
            tObject['aspect'] = 1;
            $.extend(tObject,data);
            this.textures[id] = tObject;
        },
        loadTexture: function(id, callback) {
            if(typeof this.textures[id] == 'undefined'){
                console.debug("Texture Not Found");
                return false;
            }

            if(this.textures[id]['status'] == STATUS_LOADED){
                if(typeof callback == 'function'){
                    callback();
                }
            }

            this.textures[id]['status'] = STATUS_LOADING;
            var loader = new THREE.ImageLoader( this.manager );
            loader.crossOrigin = 'anonymous';
            loader.load( this.textures[id]['path']+'.png', ( image ) => {
                image.crossOrigin = "Anonymous";
                this.textures[id]['status'] = STATUS_LOADED;
                this.textures[id]['original_image'] = image;
                this.textures[id]['texture'].rotation = 0;
                this.textures[id]['texture'].image = image;
                this.textures[id]['texture'].needsUpdate = true;
                this.textures[id]['texture'].wrapS = this.textures[id]['texture'].wrapT = THREE.RepeatWrapping;
                this.textures[id]['texture'].repeat.set(this.textures[id].aspect*this.tile,this.tile);
                if(typeof callback == 'function'){
                    callback();
                }
            });
        },
        loadTextureFromData: function(id, data, callback) {
            if(typeof this.textures[id] == 'undefined'){
                console.debug("Texture Not Found");
                return false;
            }

            if(this.textures[id]['status'] == STATUS_LOADED){
                if(typeof callback == 'function'){
                    callback();
                }
            }

            this.textures[id]['status'] = STATUS_LOADING;
            var loader = new THREE.ImageLoader( this.manager );
            loader.crossOrigin = 'anonymous';
            loader.load( data , ( image ) => {
                image.crossOrigin = "Anonymous";
                this.textures[id]['status'] = STATUS_LOADED;
                this.textures[id]['texture'].rotation = 0;
                this.textures[id]['texture'].image = image;
                this.textures[id]['texture'].needsUpdate = true;
                this.textures[id]['texture'].wrapS = this.textures[id]['texture'].wrapT = THREE.RepeatWrapping;
                this.textures[id]['texture'].repeat.set(this.textures[id].aspect*this.tile,this.tile);
                if(typeof onLoaded == 'function'){
                    onLoaded();
                }
            });
        },
        applyTexture: function(id, scene, callback){
            this.selectedTexture = id;

            this.scenes[scene].texture = id;
            if(typeof this.textures[id] == 'undefined'){

                this.interval = 0;
                return;
            }

            this.texShader = {
                uniforms: THREE.UniformsUtils.merge([
                    THREE.UniformsLib['lights'],
                    {
                        tex: { type: "t", value: this.textures[id].texture },
                        ttile: { type: "i", value: this.tile },
                        hoffset: { type: "f", value: this.offset.h },
                        voffset: { type: "f", value: this.offset.v },
                        diffuse: { type: "c", value: new THREE.Color( 0xffffff ) },
                        xmovement: { type: 'f', value: this.movement.x },
                        ymovement: { type: 'f', value: this.movement.y },
                        zmovement: { type: 'f', value: this.movement.z },
                        angle: { type: 'f', value: this.angle },
                    }
                ]),

                vertexShader: [
                    "varying vec2 vUv;",
                    "varying vec2 tUv;",
                    "uniform int ttile;",
                    "uniform float hoffset;",
                    "uniform float voffset;",
                    "uniform float xmovement;",
                    "uniform float ymovement;",
                    "uniform float zmovement;",
                    "uniform float angle;",
                    "varying mat2 texmatrix;",

                    "varying vec3 vPosition;",
                    "varying vec3 vNormal;",

                    "void main() {",
                    "texmatrix = mat2(cos(angle),sin(angle),-sin(angle),cos(angle));",
                    "tUv = (uv * vec2(ttile,ttile) + vec2(hoffset,voffset))* texmatrix ;",
                    "vUv = uv;",
                    "vPosition = position + vec3(xmovement,ymovement,zmovement);",

                    "vNormal = normalize( normalMatrix * normal );",

                    "gl_Position = projectionMatrix * modelViewMatrix * vec4(vPosition, 1);",
                    "}"
                ].join("\n"),

                fragmentShader:	[
                    "uniform sampler2D tex;",

                    "varying vec2 vUv;",
                    "varying vec2 tUv;",

                    "varying vec3 vPosition;",
                    "varying vec3 vNormal;",
                    "uniform vec3 diffuse;",

                    "uniform vec3 directionalLightColor[ MAX_DIR_LIGHTS ];",
                    "uniform vec3 directionalLightDirection[ MAX_DIR_LIGHTS ];",

                    "uniform vec3 ambientLightColor;",

                    "void main() {",
                    "vec3 normal = normalize( vNormal );",

                    "vec3 dirDiffuse = vec3( 0.0 );",
                    "for( int i = 0; i < MAX_DIR_LIGHTS; i++ ) {",
                    "vec4 lDirection = viewMatrix * vec4( directionalLightDirection[ i ], 0.0 );",
                    "vec3 dirVector = normalize( lDirection.xyz );",
                    "float dirDiffuseWeight = max( dot( normal, dirVector ), 0.0 );",
                    "dirDiffuse += directionalLightColor[ i ] * diffuse * dirDiffuseWeight;",
                    "}",

                    "vec4 tColor = texture2D(tex,tUv);",

                    "vec4 color = vec4(0.1,0.1,0.1,1.0);",

                    "gl_FragColor = tColor;",
                    //"gl_FragColor = mix(tColor,color,mColor.r);",
                    "gl_FragColor.rgb = gl_FragColor.rgb * (dirDiffuse + ambientLightColor);",
                    "}"
                ].join("\n"),
            };

            var objMaterial = new THREE.ShaderMaterial({
                uniforms: this.texShader.uniforms,
                vertexShader: this.texShader.vertexShader,
                fragmentShader: this.texShader.fragmentShader,
                shading: THREE.SmoothShading,
                lights: true
            });

            objMaterial.uniforms.tex.value = this.textures[id].texture;

            if(this.textures[id]['status'] == STATUS_LOADED && this.objects[scene]['status'] == STATUS_LOADED) {

                clearInterval(this.interval);
                this.interval = 0;
                this.selectedTexture = id;
                if(typeof this.objects[scene].object !== 'undefined'){
                    var count = 0;
                    this.objects[scene].object.traverse((child) => {
                        count++;
                        if (child instanceof THREE.Mesh) {
                            if (this.objects[scene].object.children[0] !== child || this.objects[scene].object.children[1] !== child) {
                                //if (me.object.children[2] == child) {

                                //child.material = objMaterial;
                                //child.material.map = me.textures[id].texture;
                                if(child.parent.name == "" || child.parent.name == "objmtl"){
                                    child.material = objMaterial;
                                } else {
                                    child.material = _mtllib.getMaterial(child.parent.name);
                                }

                                child.material.side = THREE.DoubleSide;
                                //child.material.color.setRGB(0.5, 0.5, 0.5);
                                child.castShadow = true;
                                child.receiveShadow = false;
                            }
                        }
                    });
                    console.debug("Texture Application Complete");
                    if(typeof callback == 'function'){

                        var params = [];
                        params.push(this.tile);
                        params.push(this.offset.h);
                        params.push(this.offset.v);
                        params.push(this.angle);

                        callback();
                    }
                }


            } else if(this.textures[id]['status'] == STATUS_LOADING || this.objects[scene]['status'] == STATUS_ADDED) {
                if(this.interval == 0){
                    this.interval = setInterval(() => {
                        this.applyTexture(id,callback);
                    }, 1000);
                }
            } else {
                this.loadTexture(id,() => {
                    this.applyTexture(id,scene,callback);
                });
            }

        },
        addImageToHiddenCanvas: function(image, data){
            let width = data.width || false;
            let height = data.height || false;
            let angle = data.angle || false;
            let x = data.x || 0;
            let y = data.y || 0;

            if(!image) {
                return;
            }

            const context = this.hiddenCanvas.getContext('2d');
            var cx = 0;
            var cy = 0;
            if(angle) {

                if(width && height) {
                    cx = x+width/2;
                    cy = y+height/2;


                }
                context.translate(cx,cy);
                context.rotate(angle);
                context.translate(-cx,-cy);
            }

            if(width && height) {


                context.drawImage(image, x, y, width, height);


            } else {
                context.drawImage(image, x, y);
            }

            if(angle) {
                context.translate(cx,cy);
                context.rotate(-angle);
                context.translate(-cx,-cy);

            }

        },
        clearHiddenCanvas: function(){
            const context = this.hiddenCanvas.getContext('2d');
            context.clearRect(0, 0, this.hiddenCanvas.width, this.hiddenCanvas.height);
        },
        loadViewport: function(){
            $('#viewport').find('canvas').remove();
            document.getElementById('viewport').appendChild(this.renderer.domElement);
        },
        loadHiddenCanvas: function(){
            $('#hidden-port').find('canvas#hidden-canvas').remove();
            this.hiddenCanvas = document.createElement("canvas");
            this.hiddenCanvas.id = 'hidden-canvas';
            document.getElementById('hidden-port').appendChild(this.hiddenCanvas);
            this.hiddenCanvas.width = 2048;
            this.hiddenCanvas.height = 768;
        },
        loadManager: function(){
            this.manager = new THREE.LoadingManager();
        },
        loadCamera: function(){
            let screen = this.getScreen();
            this.screen.width = screen.width;
            this.screen.height = screen.height;
            this.camera_config['camera_aspect'] = (this.screen.width/this.screen.height);
            this.camera = new THREE.PerspectiveCamera( this.camera_config['camera_fov'], this.camera_config['camera_aspect'], this.camera_config['camera_near'], this.camera_config['camera_far'] );
            this.camera.position.set( this.camera_config['camera_position'].x,this.camera_config['camera_position'].y,this.camera_config['camera_position'].z );
        },
        loadRenderer: function(){
            this.renderer = new THREE.WebGLRenderer({
                antialias:true,
                alpha: true,
                preserveDrawingBuffer: true
            });


            this.renderer.setSize(this.screen.width,this.screen.height);
            this.renderer.shadowMapEnabled = true;
            this.renderer.shadowMapSoft = true;
            this.renderer.shadowMapType = THREE.PCFSoftShadowMap;
        },
        getScreen: function(){
            var myWidth = 0, myHeight = 0;
            if( typeof( window.innerWidth ) == 'number' ) {
                //Non-IE
                myWidth = window.innerWidth;
                myHeight = window.innerHeight;
            } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
                //IE 6+ in 'standards compliant mode'
                myWidth = document.documentElement.clientWidth;
                myHeight = document.documentElement.clientHeight;
            } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
                //IE 4 compatible
                myWidth = document.body.clientWidth;
                myHeight = document.body.clientHeight;
            }
            return {
                height: myHeight,
                width: myWidth
            }
        },
        render: function(){
            this.clearHiddenCanvas();
            this.addImageToHiddenCanvas(this.textures[this.selectedTexture]['original_image'],{
                x: 0,
                y: 0,
                angle: 0
            });

            if(this.design.data.template.layers) {
                this.design.data.template.layers.forEach((layer)=>{
                    if(layer.enabled) {
                        const context = this.hiddenCanvas.getContext('2d');
                        if (layer.type === 'image' && layer.image) {
                            context.globalCompositeOperation = 'source-atop';
                            this.addImageToHiddenCanvas(layer.image, {
                                x: layer.x,
                                y: layer.y,
                                angle: layer.angle,
                                width: layer.width,
                                height: layer.height
                            });
                            context.globalCompositeOperation = 'source-over';
                        } else if (layer.type === 'fill') {
                            context.globalCompositeOperation = 'source-atop';
                            context.fillStyle = layer.color;
                            context.fillRect(layer.x, layer.y, layer.width, layer.height);
                            context.globalCompositeOperation = 'source-over';

                        }
                    }
                });
            }

            if(this.layers) {
                this.layers.forEach((layer)=>{
                    if(layer.status === STATUS_LOADED && layer.canvas) {

                        const context = layer.canvas.getContext('2d');
                        if (layer.type === 'image' && layer.image) {
                            context.globalCompositeOperation = 'source-atop';

                            this.addImageToHiddenCanvas(layer.renderedImage, {
                                x: layer.x,
                                y: layer.y,
                                angle: layer.angle,
                                width: layer.width,
                                height: layer.height
                            });

                            context.globalCompositeOperation = 'source-over';
                        }
                    }
                });
            }

            let updatedTextureImageData = this.hiddenCanvas.toDataURL('image/png');
            this.loadTextureFromData(this.selectedTexture,updatedTextureImageData,()=>{
                this.renderViewport();
                this.firstRenderComplete = true;
            });
        },
        insertLayer: function(item, component){
            var layerProps = $.extend(true,{},item);
            var model = this.models[this.currentScene];
            console.log(model);
            layerProps.x = model.properties.components[component].defaultEntry.x;
            layerProps.y = model.properties.components[component].defaultEntry.y;

            this.createLayer(layerProps,(layerIndex)=>{
                this.selectedLayerIndex = layerIndex;
                this.render();
            })
        },
        removeLayer: function(index){
            this.layers.splice(this.layers.index,1);
        },
        renderViewport: function(){
            this.scenes[this.currentScene].status = STATUS_RENDERED;
            if(typeof this.renderViewport == 'function'){
                requestAnimationFrame(this.renderViewport);
            }

            if(this.animate){
                if(typeof this.objects[this.currentScene] !== 'undefined'){

                    this.objects[this.currentScene].object.rotation.x += this.animation.rotation.x;
                    this.objects[this.currentScene].object.rotation.y += this.animation.rotation.y;
                    this.objects[this.currentScene].object.rotation.z += this.animation.rotation.z;
                    this.texShader.uniforms.xmovement += this.animation.movement.x;
                    this.texShader.uniforms.ymovement += this.animation.movement.y;
                    this.texShader.uniforms.zmovement += this.animation.movement.z;
                    this.texShader.uniforms.hoffset += this.animation.offset.h;
                    this.texShader.uniforms.voffset += this.animation.offset.v;
                };

            }
            this.renderer.render(this.scenes[this.currentScene].scene, this.camera);

        },

        customizeTemplateColor: function(name, color) {
            if(this.design && this.design.data.template.layers) {
                this.design.data.template.layers.forEach((layer)=>{
                    if(layer.name === name && layer.type === 'fill') {
                        layer.color = color;
                        layer.enabled = true;
                    }
                });
                this.render();
            }
        },
        removeColor: function(name) {
            if(this.design && this.design.data.template.layers) {
                let indexToRemove = -1;
                this.design.data.template.layers.forEach((layer, index)=>{
                    if(layer.name === name) {
                        layer.enabled = false;
                    }
                });
                if(this[name]) {
                    this[name] = '';
                }
                this.render();
            }
        },
        createLayer: function(obj, cb){
            let layer = $.extend({},obj);
            layer.status = STATUS_ADDED;
            let layerIndex = this.layers.length;
            this.layers.push(layer);

            if(this.layers[layerIndex].type === 'image') {
                this.layers[layerIndex].path = obj.path;

                $('#hidden-port').find('#layer-'+layerIndex).remove();

                let layerDiv = document.createElement("div");
                layerDiv.id = 'layer-'+layerIndex;

                let layerCanvas = document.createElement("canvas");
                layerCanvas.id = 'layer-'+layerIndex+'-canvas';
                layerDiv.appendChild(layerCanvas);

                document.getElementById('hidden-port').appendChild(layerDiv);

                var artImage = new Image();
                artImage.crossOrigin = 'Anonymous';
                artImage.onload = ()=>{
                    this.layers[layerIndex].image = artImage;

                    layerCanvas.width = artImage.width;
                    layerCanvas.height = artImage.height;
                    this.layers[layerIndex].canvas = layerCanvas;

                    this.updateLayer(layerIndex,()=>{
                        this.layers[layerIndex].status = STATUS_LOADED;
                        if(typeof cb === 'function') {
                            cb(layerIndex);
                        }
                    })
                }
                artImage.src = this.layers[layerIndex].path;
            }
        },
        updateLayerColor: function(c){
            if(this.layers[this.selectedLayerIndex]) {
                this.layers[this.selectedLayerIndex].color = c;
                this.updateLayer(this.selectedLayerIndex,()=>{
                    this.render();
                });
            }
        },
        updateLayer: function(layerIndex, cb){

            const context = this.layers[layerIndex].canvas.getContext('2d');
            context.clearRect(0, 0, this.layers[layerIndex].canvas.width, this.layers[layerIndex].canvas.height);

            context.drawImage(this.layers[layerIndex].image, 0, 0);

            if(this.layers[layerIndex].color !== '') {
                context.globalCompositeOperation = 'source-atop';
                context.fillStyle = this.layers[layerIndex].color.hex;
                context.fillRect(0,0,this.layers[layerIndex].image.width, this.layers[layerIndex].image.height);
                context.globalCompositeOperation = 'source-over';
            }

            let imageData = this.layers[layerIndex].canvas.toDataURL('image/png');
            var layerLoader = new THREE.ImageLoader( this.manager );
            layerLoader.crossOrigin = 'anonymous';
            layerLoader.load( imageData , ( image ) => {
                image.crossOrigin = "Anonymous";
                this.layers[layerIndex].renderedImage = image;
                if(typeof cb === 'function') {
                    cb(layerIndex);
                }
            });


        },
        mouseDown: function(e) {
            this.isMouseDown = true;
            this.mouseInitial = {
                screenX: e.screenX,
                screenY: e.screenY,
                x: e.clientX,
                y: e.clientY
            };
        },
        mouseUp: function(e) {
            this.isMouseDown = false;
        },
        mouseMove: function(e) {
            if(this.isMouseDown) {

                var deltaX = e.screenX - this.mouseInitial.screenX;
                var deltaY = e.screenY - this.mouseInitial.screenY;

                if(this.layers[this.selectedLayerIndex]) {
                    this.layers[this.selectedLayerIndex].x += deltaX;
                    this.layers[this.selectedLayerIndex].y += deltaY;
                    this.render();
                }

                this.mouseInitial = {
                    screenX: e.screenX,
                    screenY: e.screenY,
                    x: e.clientX,
                    y: e.clientY
                };
            }
        },
        renderLayer: function(){
            this.render();
        },
        selectLayer: function(i){
            this.selectedLayerIndex = i;
        }
    }
}
