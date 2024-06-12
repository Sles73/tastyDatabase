from bs4 import BeautifulSoup
import requests

url = "https://strava.spseplzen.cz/faces/login.jsp"
result = requests.get(url)
doc = BeautifulSoup(result.text, "html.parser")

for i in range(0,8):
    jidelnicekDen1 = doc.find_all("div", {"class": "jidelnicekDen"})[i]
    den = jidelnicekDen1.find("span", {"class": "important"})
    print(den.string.strip())
    chodyDiv = jidelnicekDen1.find_all("div")[1]

    for x in range(3, 6):
        print("Obed ", x - 2)
        obedDiv = chodyDiv.find_all("div")[x]
        obedDivContent = obedDiv.get_text()
        strednik = obedDivContent.index(';')
        zavorka1 = obedDivContent.index('(')
        zavorka2 = obedDivContent.rfind('(')
        obed = obedDivContent[strednik + 2:zavorka2].strip()
        print(obed)



