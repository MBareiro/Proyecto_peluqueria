
from flask import Flask
from flask_cors import CORS
from flask_sqlalchemy import SQLAlchemy
from flask_marshmallow import Marshmallow

app = Flask(__name__)
CORS(app)

# Configuración de la base de datos
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://root:root@localhost/api_peluqueria'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

# Inicialización de las extensiones
db = SQLAlchemy(app)
ma = Marshmallow(app)

from routes.login_routes import *
from routes.user_routes import *
from routes.cliente_routes import *
from routes.servicio_routes import *
from routes.turno_routes import *
from routes.disponibilidad_routes import *
from routes.rol_routes import *
from routes.horario_routes import *
from routes.password_reset_routes import *

if __name__ == '__main__':
    app.run(debug=True, port=5000)
