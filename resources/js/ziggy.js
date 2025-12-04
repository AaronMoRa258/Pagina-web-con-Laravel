const Ziggy = {
    url: 'http:\/\/192.168.100.15',
    port: null,
    defaults: {},
    routes: {
        'sanctum.csrf-cookie': {
            uri: 'sanctum\/csrf-cookie',
            methods: ['GET', 'HEAD'],
        },
        'animes.index': { uri: '\/', methods: ['GET', 'HEAD'] },
        'animes.query': {
            uri: 'animes\/search\/{query}',
            methods: ['GET', 'HEAD'],
            parameters: ['query'],
        },
        'animes.show': {
            uri: 'animes\/{animeId}',
            methods: ['GET', 'HEAD'],
            parameters: ['animeId'],
        },
        'chapters.show': {
            uri: 'animes\/{animeId}\/cap-{chapterId}',
            methods: ['GET', 'HEAD'],
            parameters: ['animeId', 'chapterId'],
        },
        'comcis.index': { uri: 'comics', methods: ['GET', 'HEAD'] },
        'comics.query': {
            uri: 'comics\/search\/{query}',
            methods: ['GET', 'HEAD'],
            parameters: ['query'],
        },
        'comcis.show': {
            uri: 'comics\/{comicId}',
            methods: ['GET', 'HEAD'],
            parameters: ['comicId'],
        },
        login: { uri: 'login', methods: ['GET', 'HEAD'] },
        register: { uri: 'register', methods: ['GET', 'HEAD'] },
        'verification.notice': {
            uri: 'verify-email',
            methods: ['GET', 'HEAD'],
        },
        'verification.verify': {
            uri: 'verify-email\/{id}\/{hash}',
            methods: ['GET', 'HEAD'],
            parameters: ['id', 'hash'],
        },
        'verification.send': {
            uri: 'email\/verification-notification',
            methods: ['POST'],
        },
        dashboard: { uri: 'dashboard', methods: ['GET', 'HEAD'] },
        'profile.edit': { uri: 'profile', methods: ['GET', 'HEAD'] },
        'profile.update': { uri: 'profile', methods: ['PATCH'] },
        'profile.destroy': { uri: 'profile', methods: ['DELETE'] },
        'password.request': {
            uri: 'forgot-password',
            methods: ['GET', 'HEAD'],
        },
        'password.email': { uri: 'forgot-password', methods: ['POST'] },
        'password.reset': {
            uri: 'reset-password\/{token}',
            methods: ['GET', 'HEAD'],
            parameters: ['token'],
        },
        'password.store': { uri: 'reset-password', methods: ['POST'] },
        'password.confirm': {
            uri: 'confirm-password',
            methods: ['GET', 'HEAD'],
        },
        'password.update': { uri: 'password', methods: ['PUT'] },
        logout: { uri: 'logout', methods: ['POST'] },
        'storage.local': {
            uri: 'storage\/{path}',
            methods: ['GET', 'HEAD'],
            wheres: { path: '.*' },
            parameters: ['path'],
        },
    },
};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
