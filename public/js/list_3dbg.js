var camera,scene,renderer;
var container;

init();
animate();

function init()
{
    container = document.getElementById('container-canvas');

    camera = new THREE.PerspectiveCamera(30, window.innerWidth/window.innerHeight, 1, 1000);
    camera.position.z = 1000;

    scene = new THREE.Scene();
    scene.background = new THREE.Color(0x080808);

    renderer = new THREE.WebGLRenderer();
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setSize(window.innerWidth, window.innerHeight);
    container.appendChild(renderer.domElement);    

    var geometry = new THREE.BoxGeometry(200, 200, 200); 
    var material = new THREE.MeshBasicMaterial({ color:0xffaaff });
    var cube = new THREE.Mesh(geometry, material);

    scene.add(cube);

    window.addEventListener('resize', onWindowResize, false);
}

function animate()
{
    requestAnimationFrame(animate);

    renderer.render(scene, camera);
}

function onWindowResize()
{
    camera.aspect = window.innerWidth/window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
}
