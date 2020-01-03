#!/usr/bin/python3
from pathlib import Path
from string import punctuation
import os
import sys


def clean(dokumen):
    with open(f'../data/clean/{dokumen[1]}', 'w') as file:
        for index, line in enumerate(dokumen[0].split('\n')):
            if index is 1:
                main_sentence = line.split('.')
                try:
                    file.write(main_sentence[0].translate(
                        str.maketrans('', '', punctuation))+'\n')
                except IndexError:
                    pass
                    # print('index error..')
                for sentence in main_sentence[1:]:
                    file.write(sentence.translate(
                        str.maketrans('', '', punctuation)))
                continue
            file.write(line.translate(
                str.maketrans('', '', punctuation))+'\n')


if os.path.exists('../data/crawling'):
    print(f'Directory : ../data/crawling')
    print('Sedang diproses...')
    for f in Path('.').glob(f"../data/crawling/*.txt"):
        name = str(f).split('/')
        File = open(f, 'r').read()
        clean([File, name[3]])
else:
    print("Salah Direktori, silahkan cek direktori Anda")
    sys.exit(1)
