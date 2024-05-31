const video = document.getElementById('videoElement');
const canvas = document.getElementById('overlay');
let contadorReconocimiento = 0;
let ejecutando = false;
let puntosFacialesJSON = [];

(async () => {
    const stream = await navigator.mediaDevices.getUserMedia({ video: {} });
    video.srcObject = stream;
})();

async function onPlay() {
    if(ejecutando) return;
    ejecutando = true;
    
    const MODEL_URL = '../models';

    await faceapi.loadSsdMobilenetv1Model(MODEL_URL);
    await faceapi.loadFaceLandmarkModel(MODEL_URL);
    await faceapi.loadFaceRecognitionModel(MODEL_URL);
    await faceapi.loadFaceExpressionModel(MODEL_URL);

    // Obtener el Id del usuario almacenado en localStorage
    const id_usuario = localStorage.getItem("id_usuario");

    // Detectar rostros y extraer características faciales
    let fullFaceDescriptions = await faceapi.detectAllFaces(video)
        .withFaceLandmarks()
        .withFaceDescriptors()
        .withFaceExpressions();

    const dims = faceapi.matchDimensions(canvas, video, true);
    const resizedResults = faceapi.resizeResults(fullFaceDescriptions, dims);

    faceapi.draw.drawDetections(canvas, resizedResults);
    faceapi.draw.drawFaceLandmarks(canvas, resizedResults);
    faceapi.draw.drawFaceExpressions(canvas, resizedResults, 0.05);

    contadorReconocimiento++;
    console.log("Numero de reconocimientos: ", contadorReconocimiento);

    // Acceder a las coordenadas de los puntos faciales
    resizedResults.forEach(resultado => {
        const puntosFaciales = resultado.landmarks.positions;
        puntosFacialesJSON.push({ coordenadas: puntosFaciales, id_usuario: id_usuario });
        console.log('Coordenadas de los puntos faciales: ', puntosFaciales);
    });

    const puntosFacialesJSONString = JSON.stringify(puntosFacialesJSON);
    console.log('Puntos faciales en JSON: ', puntosFacialesJSONString);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/datosCara.php");
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(puntosFacialesJSONString);
}

document.getElementById('btnContinuar').addEventListener('click', function(event) {
    event.preventDefault();
    onPlay();
});
