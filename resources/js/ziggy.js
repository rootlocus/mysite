const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"livewire.message":{"uri":"livewire\/message\/{name}","methods":["POST"]},"livewire.upload-file":{"uri":"livewire\/upload-file","methods":["POST"]},"livewire.preview-file":{"uri":"livewire\/preview-file\/{filename}","methods":["GET","HEAD"]},"playground.steam.index":{"uri":"playground\/steam","methods":["GET","HEAD"]},"playground.steam.submit":{"uri":"playground\/steam","methods":["POST"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
