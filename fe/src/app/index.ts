import api from "@/router/api";
import type Filters from "@/app/filters";

export default class AppService {
    private parametrizeArray(key: string, arr: Array<string> | null): string {
        if (!arr) return '';
        if (arr.length === 0) return '';
        arr = arr.map(encodeURIComponent)
        return key + '[]=' + arr.join('&' + key + '[]=')
    }

    public addToOrder(wineId: number, order: Object | null): Promise<Object> {
        return fetch(api.order.update(order?.id), {
            method: 'PUT',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify({
                'wine_id': wineId
            }),
        })
    }

    public removeFromOrder(wineId: number, order: Object | null): Promise<Object> {
        return fetch(api.order.removeUpdate(order?.id), {
            method: 'PUT',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify({
                'wine_id': wineId
            }),
        })
    }

    public getWines(filters: Filters): Promise<Object> {
        return fetch(
            `${api.wines.index()}?${[
                this.parametrizeArray('sort', filters.sort),
                this.parametrizeArray('style', filters.style)
            ].join('&')}`
        );
    }

    public getStyles(filters: Filters): Promise<Object> {
        return fetch(`${api.wines.wine_styles()}?${[
            this.parametrizeArray('sort', filters.sort),
        ].join('&')}`);
    }

    public getSorts(filters: Filters): Promise<Object> {
        return fetch(`${api.wines.wine_sorts()}?${[
            this.parametrizeArray('style', filters.style)
        ].join('&')}`);
    }
}
