const canvas = document.getElementById("kanva");
const ctx = canvas.getContext("2d");

function puhasta() {
    const canvas = document.getElementById("kanva");
    const ctx = canvas.getContext("2d");
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function katus() {
    const canvas = document.getElementById("kanva");
    const ctx = canvas.getContext("2d");
    ctx.beginPath();
    ctx.moveTo(150, 150);
    ctx.lineTo(250, 80);
    ctx.lineTo(350, 150);
    ctx.closePath();
    ctx.fillStyle = "brown";
    ctx.fill();
    ctx.stroke();
}

function seinad() {
    const canvas = document.getElementById("kanva");
    const ctx = canvas.getContext("2d");
    ctx.fillStyle = "lightyellow";
    ctx.fillRect(150, 150, 200, 200);
    ctx.strokeRect(150, 150, 200, 200);
}

function uks() {
    const canvas = document.getElementById("kanva");
    const ctx = canvas.getContext("2d");
    ctx.fillStyle = "saddlebrown";
    ctx.fillRect(230, 250, 40, 100);
    ctx.strokeRect(230, 250, 40, 100);
}

function akenVasakul() {
    const canvas = document.getElementById("kanva");
    const ctx = canvas.getContext("2d");
    ctx.fillStyle = "lightblue";
    ctx.fillRect(170, 180, 40, 40);
    ctx.strokeRect(170, 180, 40, 40);
}

function akenParemal() {
    const canvas = document.getElementById("kanva");
    const ctx = canvas.getContext("2d");
    ctx.fillStyle = "lightblue";
    ctx.fillRect(290, 180, 40, 40);
    ctx.strokeRect(290, 180, 40, 40);
}

function koik() {
    const canvas = document.getElementById("kanva");
    const ctx = canvas.getContext("2d");
    puhasta();
    katus();
    seinad();
    uks();
    akenVasakul();
    akenParemal();
}
