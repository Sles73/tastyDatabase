import argparse
import cv2

def main():
    parser = argparse.ArgumentParser(description='Greet the user.')
    parser.add_argument('name', nargs='?', default='World', help='The name to greet')
    
    args = parser.parse_args()
    
    print(args.name)

if __name__ == '__main__':
    main()
