var camera,scene,renderer;
var container;
var stats;
var cube;
var ballMesh;
const wWidth = window.innerWidth;
const wHeight = window.innerHeight;
const groundWidth = 2000;
const groundHeight = 2000;
var flag = true;
var windwill,windwill1;

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

    var groundTexture = new THREE.TextureLoader().load('/images/grassland.jpg');
    groundTexture.wrapS = groundTexture.wrapT = THREE.Repeatwrapping;
    groundTexture.repeat.set(25, 25);
    groundTexture.anisotropy = 16;
    var groundMaterial = new THREE.MeshLambertMaterial({ map: groundTexture });
    var mesh = new THREE.Mesh(new THREE.PlaneBufferGeometry(groundWidth, groundHeight), groundMaterial);
    mesh.rotation.x = -1;
    mesh.receiveShadow = true;
    scene.add(mesh);

    var windwillGeometry = new THREE.PlaneBufferGeometry(50, 400);
    var windwillMaterial = new THREE.MeshLambertMaterial({ color: "white"});
    windwill = new THREE.Mesh(windwillGeometry, windwillMaterial);
    windwill.castShadow = true;
    windwill.position.z = 90;
    windwill.position.x = -230;
    windwill.position.y = 400;
    scene.add(windwill);

    windwill1 = windwill.clone();
    windwill1.rotation.z = 80;
    scene.add(windwill1);

    var cylinderGeometry = new THREE.CylinderGeometry(30, 100, 900, 32);
    var cylinderTexture = new THREE.TextureLoader().load('/images/cylinder.jpg');
    var cylinderMaterial = new THREE.MeshLambertMaterial({ map: cylinderTexture });
    var cylinder = new THREE.Mesh(cylinderGeometry, cylinderMaterial);
    cylinder.castShadow = true;
    cylinder.position.z = 40;
    cylinder.position.x = -230;
    scene.add(cylinder);

    var cylinderAxisGeometry = new THREE.CylinderGeometry(5, 5, 50, 32);
    var cylinderAxisMaterial = new THREE.MeshLambertMaterial({ color: "black"});
    var cylinderAxis = new THREE.Mesh(cylinderAxisGeometry, cylinderAxisMaterial);
    cylinderAxis.castShadow = true;
    cylinderAxis.rotation.x = -90;
    cylinderAxis.position.x = -230;
    cylinderAxis.position.y = 390;
    cylinderAxis.position.z = 70;
    scene.add(cylinderAxis);

    var ambientLight = new THREE.AmbientLight(0xbbbbbb);
    scene.add(ambientLight);

    var directionLight = new THREE.DirectionalLight(0xffffff, 1);
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
    
    windwill.rotation.z += 0.05;
    windwill1.rotation.z += 0.05;
   
    renderer.render(scene, camera);

    stats.update();
}

function onWindowResize()
{
    camera.aspect = window.innerWidth/window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
}
