from bs4 import BeautifulSoup
from datetime import datetime, timedelta
from pathlib import Path
import requests

url = 'https://www.tempo.co/indeks/'
date = datetime.today()

i=1
n=100
print('Proses..')
with open ('../data/link/link.txt','w') as file:
    while i != n:
        link = BeautifulSoup(requests.get(
            f'{url}{date.strftime("%Y/%m/%d")}').text, 'html.parser')

        print(f'link      : {url}{date.strftime("%Y/%m/%d")}')
        print('ditemukan :',len(link.select('.card-type-1')))
        for links in link.select('.card-type-1'):
            links = links.find('a')['href']
            file.write (links+'\n')
            try:
                soup = BeautifulSoup(requests.get(
                    links
                ).text,'html.parser')
                title = soup.find('article').find('h1').getText().strip()
                content = soup.select_one('#isi')
                for j in content('script'):
                    j.decompose()
                src = Path()/'../data/crawling'/f'data{i}.txt'
                with open(src,'w') as dokumen:
                    dokumen.write(title+'\n')
                    dokumen.write(content.getText().strip())
            except(AttributeError, UnicodeEncodeError):
                pass

            if i == n:
                break
            i+=1
        else:
            date+= timedelta(days=-1)
    print('Selesai...')