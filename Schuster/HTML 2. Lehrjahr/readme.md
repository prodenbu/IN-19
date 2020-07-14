# Aside
Zusatzinformationen

# Nav
Muss relational auf die eigene Seite verlinken
    
# Section
Kapitel wie bei Buch <br>
Zeitung Rubrik <br>
Inhaltiliche Sortiereung 

# Article
Zeitungsartikel <br>
Blogartikel <br>
Verschiedene Inhalte bei gleicher Darstellung

# CSS

## CSS aufbau
Ein einfacher CSS Tag: <br>
```css 
H1
{
    color: blue;
}
```
## Typselektoren
Alles ohne Klassen so wie z.B. H1 und nicht H1.Class

## Klassenselektoren
Klassen können jedem HTML Tag hinzugefügt werden, welche dann in CSS verwendet werden, um alle Tags mit der Klasse zu editieren. Eine Klasse kann man bei beliebig vielen Tags verwenden und eine bei einem Tag kann man beliebig viele Klassen verwenden. Klassenselektoren können mit oder ohne Typselektoren verwendet werden.
```css
H1.gruen
{
    color: green;
}
```
```html
<h1 class="gruen">Diese Überschrift wird grün</h1>
```