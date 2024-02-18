import api from "@/router/api";
import type Filters from "@/app/filters";

export default class AppService {
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
        const parameterizeArray = (key: string, arr: Array<string> | null) => {
            if (!arr) return '';
            arr = arr.map(encodeURIComponent)
            return key + '[]=' + arr.join('&' + key + '[]=')
        }

        return fetch(
            `${api.wines.index()}?${[
                parameterizeArray('sort', filters.sort),
                parameterizeArray('style', filters.style)
            ].join('&')}`
        );
    }

    public getStyles(): Promise<Object> {
        return fetch(api.wines.wine_styles());
    }

    public getSorts(): Promise<Object> {
        return fetch(api.wines.wine_sorts());
    }
}
