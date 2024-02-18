export default {
    wines: {
        index: () => 'https://fpis-projekat.ddev.site/api/wines',
        wine_styles: () => 'https://fpis-projekat.ddev.site/api/wine-styles',
        wine_sorts: () => 'https://fpis-projekat.ddev.site/api/wine-sorts',
    },
    order: {
        update: (orderId: number | null) => orderId ? `https://fpis-projekat.ddev.site/api/order/${orderId}` : 'https://fpis-projekat.ddev.site/api/order',
        removeUpdate: (orderId: number) => `https://fpis-projekat.ddev.site/api/order/remove/${orderId}`,
    }
};
