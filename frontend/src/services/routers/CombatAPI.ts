import APIHandler from '../APIHandler';
const resource = 'combat';

const userUUID = "20bfbda7-8771-4876-88e2-d2b97ce29835"; // Temporary hardcoded user UUID for testing

export default {
    startCombat() {
        return APIHandler.post(`${resource}/start/${userUUID}`);
    },

    attackCombat(combatId: string, attackType: string) {
        return APIHandler.post(`${resource}/${combatId}/action/${attackType}`);
    }
}