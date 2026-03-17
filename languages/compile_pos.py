import os
import polib

LANG_DIR = 'languages'

for filename in os.listdir(LANG_DIR):
    if filename.endswith('.po'):
        po_path = os.path.join(LANG_DIR, filename)
        mo_path = os.path.splitext(po_path)[0] + '.mo'
        po = polib.pofile(po_path)
        po.save_as_mofile(mo_path)
        print(f'Compiled {po_path} -> {mo_path}')
