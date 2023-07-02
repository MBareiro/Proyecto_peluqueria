from app import db

class Horario(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    day = db.Column(db.String(50))
    active_morning = db.Column(db.Boolean)
    morning_start = db.Column(db.Time)
    morning_end = db.Column(db.Time)
    active_afternoon = db.Column(db.Boolean)
    afternoon_start = db.Column(db.Time)
    afternoon_end = db.Column(db.Time)
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'))
    created_at = db.Column(db.DateTime)
    updated_at = db.Column(db.DateTime)

    def __init__(self, day, active_morning, morning_start, morning_end, active_afternoon, afternoon_start, afternoon_end, user_id):
        self.day = day
        self.active_morning = active_morning
        self.morning_start = morning_start
        self.morning_end = morning_end
        self.active_afternoon = active_afternoon
        self.afternoon_start = afternoon_start
        self.afternoon_end = afternoon_end
        self.user_id = user_id
