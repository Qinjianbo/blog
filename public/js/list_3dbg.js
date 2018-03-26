var camera,scene,renderer;
var container;
var stats;
var cube;
var ballMesh;
const wWidth = window.innerWidth;
const wHeight = window.innerHeight;
const groundWidth = 3000;
const groundHeight = 2000;
var flag = true;
var windwill;

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
    scene.background = new THREE.Color(0x000000);

    var groundTexture = new THREE.TextureLoader().load('/images/grassland.jpg');
    groundTexture.wrapS = groundTexture.wrapT = THREE.Repeatwrapping;
    groundTexture.repeat.set(25, 25);
    groundTexture.anisotropy = 16;
    var groundMaterial = new THREE.MeshLambertMaterial({ map: groundTexture });
    var mesh = new THREE.Mesh(new THREE.PlaneBufferGeometry(groundWidth, groundHeight), groundMaterial);
    mesh.rotation.x = -1;
    mesh.receiveShadow = true;
    scene.add(mesh);

    var ball = new THREE.SphereBufferGeometry(30, 32, 32);
    var ballTexture = new THREE.TextureLoader().load('/images/bg1.jpg');
    var ballMaterial = new THREE.MeshLambertMaterial({ map: ballTexture });
    ballMesh = new THREE.Mesh(ball, ballMaterial);
    ballMesh.position.z = 100;
    ballMesh.position.x = -(wWidth/2);
    scene.add(ballMesh);

    var windwillGeometry = new THREE.PlaneBufferGeometry(50, 400);
    var windwillMaterial = new THREE.MeshLambertMaterial({ color: "white"});
    windwill = new THREE.Mesh(windwillGeometry, windwillMaterial);
    windwill.position.z = 10;
    windwill.position.x = -230;
    windwill.position.y = 400;
    scene.add(windwill);

    var cylinderGeometry = new THREE.CylinderGeometry(30, 100, 800, 32);
    var cylinderMaterial = new THREE.MeshLambertMaterial({ color: "#48c9ff"});
    var cylinder = new THREE.Mesh(cylinderGeometry, cylinderMaterial);
    cylinder.position.z = -25;
    cylinder.position.x = -230;
    scene.add(cylinder);

    var ambientLight = new THREE.AmbientLight(0xffffff);
    scene.add(ambientLight);

    renderer = new THREE.WebGLRenderer();
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setSize(wWidth, wHeight);
    container.appendChild(renderer.domElement);    

    stats = new Stats();
    document.body.appendChild(stats.dom);

    window.addEventListener('resize', onWindowResize, false);
}

function animate()
{
    requestAnimationFrame(animate);
    
    if (ballMesh.position.x < wWidth/2) {
        ballMesh.position.x += 3;
        ballMesh.rotation.z -= 0.03;
    }

    windwill.rotation.z += 0.25;
   
    renderer.render(scene, camera);

    stats.update();
}

function onWindowResize()
{
    camera.aspect = window.innerWidth/window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
}
