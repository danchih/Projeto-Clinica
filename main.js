const { app, BrowserWindow, ipcMain } = require('electron');
const path = require('path');
const url = require('url');

// Função para criar a janela principal
function createWindow() {
    const win = new BrowserWindow({
        width: 800,
        height: 600,
        webPreferences: {
            nodeIntegration: false, // Necessário desativar para segurança
            contextIsolation: true, // Isolar o contexto da renderização para segurança
            preload: path.join(__dirname, 'preload.js') // Pré-carrega um script na página renderizada
        }
    });

    // Carregar o arquivo index.html da sua aplicação Vue.js
    win.loadURL(url.format({
        pathname: path.join(__dirname, 'welcome.vue'),
        protocol: 'file:',
        slashes: true
    }));

    // Abrir as ferramentas de desenvolvedor
    win.webContents.openDevTools();
}

// Evento de quando o aplicativo estiver pronto
app.whenReady().then(createWindow);

// Sair quando todas as janelas estiverem fechadas
app.on('window-all-closed', () => {
    if (process.platform !== 'darwin') {
        app.quit();
    }
});

// Evento de ativação (macOS)
app.on('activate', () => {
    if (BrowserWindow.getAllWindows().length === 0) {
        createWindow();
    }
});

// Lidar com mensagens IPC do processo de renderização
ipcMain.on('login-successful', (event, arg) => {
    // Navegar para a página "homecliente" após o login bem-sucedido
    mainWindow.loadURL(`file://${path.join(__dirname, '/HomeCliente.vue')}`);
});
