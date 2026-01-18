/**
 * Flappy Bird Score Generator
 * Frontend JavaScript for generating score images using Canvas
 */

// DOM Elements
const titleEl = document.getElementById('tit');
const labelEl = document.getElementById('txt');
const submitBtn = document.getElementById('sub');
const downloadBtn = document.getElementById('downloadBtn');
const scoreForm = document.getElementById('scoreForm');
const scoreInput = document.getElementById('scoreInput');
const canvas = document.getElementById('resultCanvas');
const ctx = canvas.getContext('2d');

// Image resources
const images = {
    bg: new Image(),
    bronze: new Image(),
    silver: new Image(),
    gold: new Image(),
    platinum: new Image()
};

// Configuration
const config = {
    medalPosition: { x: 126, y: 384, width: 99, height: 102 },
    scorePosition: { baseX: 494, baseX1: 504, y: 408, spacing: 35 },
    bestOffset: 93,
    fontSize: 36,
    outlineWidth: 3,
    fontFamily: 'FlappyFont, sans-serif'
};

// Localization
const i18n = {
    en: {
        title: "Flappy Bird Scores Builder. Nobody believed big numbers =.=!",
        label: "Enter Number (Flappy Bird Scores =.=!):",
        submit: "Generate",
        download: "Download Image"
    },
    zh: {
        title: "Flappy Bird 成绩生成器，数字太大没人信 =.=!",
        label: "请输入数字(数字太大没人信 =.=!)：",
        submit: ">生成<",
        download: "下载图片"
    }
};

/**
 * Initialize localization based on browser language
 */
function initLocalization() {
    const lang = navigator.language;
    const isZh = lang === 'zh-CN' || lang === 'zh-cn' || lang.startsWith('zh');
    const strings = isZh ? i18n.zh : i18n.en;

    titleEl.textContent = strings.title;
    labelEl.textContent = strings.label;
    submitBtn.textContent = strings.submit;
    downloadBtn.textContent = strings.download;
}

/**
 * Load custom font
 */
async function loadFont() {
    try {
        const font = new FontFace('FlappyFont', 'url(./assets/fonts/04B_19__.TTF)');
        await font.load();
        document.fonts.add(font);
        console.log('Font loaded successfully');
    } catch (error) {
        console.error('Font loading failed:', error);
    }
}

/**
 * Load all images
 */
function loadImages() {
    return new Promise((resolve) => {
        let loadedCount = 0;
        const totalImages = Object.keys(images).length;

        const onLoad = () => {
            loadedCount++;
            if (loadedCount === totalImages) {
                resolve();
            }
        };

        images.bg.onload = onLoad;
        images.bronze.onload = onLoad;
        images.silver.onload = onLoad;
        images.gold.onload = onLoad;
        images.platinum.onload = onLoad;

        images.bg.src = './assets/images/bg.jpg';
        images.bronze.src = './assets/images/bronze.jpg';
        images.silver.src = './assets/images/silver.jpg';
        images.gold.src = './assets/images/gold.jpg';
        images.platinum.src = './assets/images/platinum.jpg';
    });
}

/**
 * Get medal image based on score
 */
function getMedalImage(score) {
    if (score >= 40) return images.platinum;
    if (score >= 30) return images.gold;
    if (score >= 20) return images.silver;
    if (score >= 10) return images.bronze;
    return null;
}

/**
 * Draw text with outline effect
 */
function drawTextWithOutline(text, x, y) {
    const { fontSize, outlineWidth, fontFamily } = config;

    ctx.font = `${fontSize}px ${fontFamily}`;
    ctx.textBaseline = 'alphabetic';

    // Draw black outline
    ctx.fillStyle = 'rgb(2, 2, 2)';
    ctx.fillText(text, x - outlineWidth, y - outlineWidth);
    ctx.fillText(text, x + outlineWidth, y - outlineWidth);
    ctx.fillText(text, x - outlineWidth, y + outlineWidth);
    ctx.fillText(text, x + outlineWidth, y + outlineWidth);

    // Draw white text
    ctx.fillStyle = 'rgb(254, 254, 254)';
    ctx.fillText(text, x, y);
}

/**
 * Draw score digits
 */
function drawScore(score, yOffset = 0) {
    const scoreStr = score.toString();
    const { baseX, baseX1, y, spacing } = config.scorePosition;

    for (let i = 1; i <= scoreStr.length; i++) {
        const digit = scoreStr.charAt(scoreStr.length - i);
        const x = digit === '1'
            ? baseX1 - ((i - 1) * spacing)
            : baseX - ((i - 1) * spacing);

        drawTextWithOutline(digit, x, y + yOffset);
    }
}

/**
 * Generate score image
 */
function generateScore(score) {
    // Set canvas size
    canvas.width = images.bg.width;
    canvas.height = images.bg.height;

    // Draw background
    ctx.drawImage(images.bg, 0, 0);

    // Draw medal
    const medal = getMedalImage(score);
    if (medal) {
        const { x, y, width, height } = config.medalPosition;
        ctx.drawImage(medal, x, y, width, height);
    }

    // Draw current score
    drawScore(score, 0);

    // Draw best score (same as current for this demo)
    drawScore(score, config.bestOffset);
}

/**
 * Download canvas as image
 */
function downloadImage() {
    const score = scoreInput.value || '0';
    const link = document.createElement('a');
    link.download = `flappy-bird-score-${score}.png`;
    link.href = canvas.toDataURL('image/png');
    link.click();
}

/**
 * Handle form submission
 */
function handleSubmit(e) {
    e.preventDefault();
    const score = parseInt(scoreInput.value, 10) || 0;
    generateScore(score);
}

/**
 * Initialize application
 */
async function init() {
    initLocalization();

    // Load resources
    await Promise.all([loadFont(), loadImages()]);

    // Generate initial score
    generateScore(102);

    // Event listeners
    scoreForm.addEventListener('submit', handleSubmit);
    downloadBtn.addEventListener('click', downloadImage);
}

// Start application
init();
