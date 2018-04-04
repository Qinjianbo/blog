var camera,scene,renderer;
var container;
var stats;
const wWidth = window.innerWidth;
const wHeight = window.innerHeight;
const groundWidth = 2000;
const groundHeight = 2000;
var groupAll;
var windwillGroup,windwillLeafGroup,windwillLeaf1,windwillLeaf2,windwillBody,windwillAxis;
var directionLight;

init();
animate();

function init()
{
    container = document.getElementById('container-canvas');

    camera = new THREE.PerspectiveCamera(70, wWidth/wHeight, 1, 1000);
    camera.position.z = 1000;
    camera.position.y = 10;
    camera.lookAt(new THREE.Vector3(0, 0, 0));

    scene = new THREE.Scene();
    scene.background = new THREE.Color(0xffffff);

    initGroup();
    ground();
    windwill();

    scene.add(groupAll);

    var ambientLight = new THREE.AmbientLight(0xbbbbbb);
    scene.add(ambientLight);

    directionLight();
    scene.add(directionLight);

    renderer = new THREE.WebGLRenderer();
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setSize(wWidth, wHeight);
    container.appendChild(renderer.domElement);    
    renderer.gammaInput = true;
    renderer.gammaOutput = true;
    renderer.shadowMap.enabled = true;

    stats = new Stats();
    document.body.appendChild(stats.dom);

    window.addEventListener('resize', onWindowResize, false);
}

function animate()
{
    requestAnimationFrame(animate);
    
    windwillLeaf1.rotation.z += 0.05;
    windwillLeaf2.rotation.z += 0.05;

    renderer.render(scene, camera);

    stats.update();
}

function onWindowResize()
{
    camera.aspect = window.innerWidth/window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
}

function initGroup()
{
    groupAll = new THREE.Group();
    windwillGroup = new THREE.Group();
    windwillLeafGroup = new THREE.Group();
}

function ground()
{
    var groundTexture = new THREE.TextureLoader().load('/images/grassland.jpg');
    groundTexture.wrapS = groundTexture.wrapT = THREE.Repeatwrapping;
    groundTexture.repeat.set(25, 25);
    groundTexture.anisotropy = 16;
    var groundMaterial = new THREE.MeshLambertMaterial({ map: groundTexture });
    var mesh = new THREE.Mesh(new THREE.PlaneBufferGeometry(groundWidth, groundHeight), groundMaterial);
    mesh.rotation.x = -1;
    mesh.receiveShadow = true;
//    groupAll.add(mesh);
}

function windwill()
{
    var windwillGeometry = new THREE.PlaneBufferGeometry(50, 400);
    var windwillMaterial = new THREE.MeshLambertMaterial({ color: "white"});
    windwillLeaf1 = new THREE.Mesh(windwillGeometry, windwillMaterial);
    windwillLeaf1.castShadow = true;
    windwillLeaf1.position.set(-230, 400, 90);

    windwillLeaf2 = windwillLeaf1.clone();
    windwillLeaf2.rotation.z = 80;

    windwillLeafGroup.add(windwillLeaf1);
    windwillLeafGroup.add(windwillLeaf2);

    windwillGroup.add(windwillLeafGroup);

    var cylinderGeometry = new THREE.CylinderGeometry(30, 100, 900, 32);
    var cylinderTexture = new THREE.TextureLoader().load('/images/cylinder.jpg');
    cylinderTexture.wrapS = cylinderTexture.wrapT = THREE.Repeatwrapping;
    cylinderTexture.repeat.set(25, 25);
    cylinderTexture.anisotropy = 16;
    var cylinderMaterial = new THREE.MeshLambertMaterial({ map: cylinderTexture });
    windwillBody = new THREE.Mesh(cylinderGeometry, cylinderMaterial);
    windwillBody.castShadow = true;
    windwillBody.position.z = 40;
    windwillBody.position.x = -230;

    windwillGroup.add(windwillBody);

    var cylinderAxisGeometry = new THREE.CylinderGeometry(5, 5, 50, 32);
    var cylinderAxisMaterial = new THREE.MeshLambertMaterial({ color: "black"});
    windwillAxis = new THREE.Mesh(cylinderAxisGeometry, cylinderAxisMaterial);
    windwillAxis.castShadow = true;
    windwillAxis.rotation.x = -90;
    windwillAxis.position.x = -230;
    windwillAxis.position.y = 390;
    windwillAxis.position.z = 70;

    windwillGroup.add(windwillAxis);

    groupAll.add(windwillGroup);
}

function directionLight()
{
    directionLight = new THREE.DirectionalLight(0xffffff, 1);
    directionLight.position.set(-200, 400, -200);
    directionLight.position.multiplyScalar(1.3);
    directionLight.castShadow = true;
    directionLight.shadow.mapSize.width = 2048;
    directionLight.shadow.mapSize.height = 2048;
    var d = 3000;
    directionLight.shadow.camera.left = -d;
    directionLight.shadow.camera.right = d;
    directionLight.shadow.camera.top = d;
    directionLight.shadow.camera.bottom = -d;
    directionLight.shadow.camera.far = 2000;
}
