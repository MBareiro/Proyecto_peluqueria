from app import db, app

class Login(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(255))
    password = db.Column(db.String(255))
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'))

    def __init__(self, username, password, user_id):
        self.username = username
        self.password = password
        self.user_id = user_id

with app.app_context():
    db.create_all()