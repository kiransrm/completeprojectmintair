# Hello World program in Python
    
#!/usr/bin/env python

import random
import json

Aindex = random.randint(1,5)
Avalue = 75 + random.randint(-50,50)

tempC = 30 + random.randint(20,20)
Humidity = 35.5 + random.randint(20,20)
Co2 = 400 + random.randint(200,200)
TvoC = 0.0 + (random.randint(40,40) / 10)
pm2_5 = 0.2 + (random.randint(40,40) / 10)
pm10 = 0.1 + (random.randint(40,40) / 10)

temperature = tempC * 1.8 + 32.0
temperature = round(temperature,1)
D = {'temperature':temperature, 'Humidity': Humidity,'Co2':Co2,'TvoC':TvoC,'pm2_5':pm2_5,'pm10':pm10,'Aindex':Aindex,'Avalue':Avalue}
print json.dumps(D)