import {createReduxStore, register} from '@wordpress/data';
import * as actions from './actions';
import * as selectors from './selectors';

export type Notification = {
    id: string;
    notificationType: 'notice' | 'snackbar';
    type: 'error' | 'warning' | 'info' | 'success';
    isDismissible?: boolean;
    duration: number,
    content: string;
}

export const store = createReduxStore('givewp/admin-details-page-notifications', {
    reducer(state = [], action) {
        switch (action.type) {
            case 'ADD_NOTIFICATION':
                const notificationExist = state.filter((notification: { id: string }) => notification.id === action.notification.id);
                if (!notificationExist.length) {
                    return [...state, action.notification];
                }
                return state;

            case 'DISMISS_NOTIFICATION':
                return state.filter((notification: Notification) => notification.id !== action.id);
        }

        return state;
    },
    actions,
    selectors,
});

register(store);
