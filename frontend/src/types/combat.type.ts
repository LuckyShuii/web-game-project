export interface CombatState {
  turn: 'PLAYER' | 'ENEMY';
  enemy: {
    hp: number;
    code: string;
  };
  player: {
    hp: number;
    mana: number;
    maxMana: number;
  };
  turnCount: number;
}

export interface Combat {
  id: string;
  status: 'IN_PROGRESS' | 'COMPLETED' | 'FAILED';
  enemy: string;
  state: CombatState;
  startedAt: string;
  endedAt: string | null;
}

export interface CombatResponse {
  combat: Combat;
  already_in_progress: boolean;
}